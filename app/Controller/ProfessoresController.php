<?php
App::uses('AppController', 'Controller');

/**
 * Professores Controller
 *
 * @property Area $Area
 */
class ProfessoresController extends AppController {

    var $scaffold;

    public function index() {
        $this->Professor->recursive = 0;
        $this->set('professores', $this->Professor->find('all'));
    }

	/**
	 * add method
	 *
	 * @return void
	 */
	public function adicionar() {
		// Send a POST request with application/x-www-form-urlencoded encoded data
		if ($this->request->is('post')) {

            if($this->request->data['Professor']['email'] == $this->request->data['Professor']['confirmar_email']){

                //verifica se ja existe um usuario com o nome de usuario digitado
                $options = array('conditions' => array('Professor.rp'=> $this->request->data['Professor']['rp']));
                $ProfessorExiste = $this->Professor->find('first', $options);

                if(!$ProfessorExiste){

                    //verifica se ja existe um usuario com o nome de email digitado
                    $options = array('conditions' => array('Usuario.email'=> $this->request->data['Professor']['email']));
                    $EmailExiste = $this->Usuario->find('first', $options);

                    if(!$EmailExiste){

                        //cria usuario
                        $this->Usuario->create();

                        //gera senha aleatoria para usuario
                        $senha = $this->gerar_senha();
                        $this->Usuario->data['Usuario']['senha'] = $senha;

                        //data de criacao
                        $this->Usuario->set('criado', null);

                        $rp = $this->request->data['Professor']['rp'];
                        $nome = $this->request->data['Professor']['nome'];

                        $newUsuario['Usuario'] = $this->request->data['Professor'];
                        $newUsuario['Usuario']['grupo_id'] = Configure::read('Sistema.professor_id');
                        $newUsuario['Usuario']['usuario'] = $this->request->data['Professor']['rp'];

                        if ($this->Usuario->save($newUsuario)) {

                        	$this->Professor->create();
                        	$newProfessor['Professor']['usuario_id'] = $this->Usuario->id;
                        	$newProfessor['Professor']['rp'] =  $this->request->data['Professor']['rp'];
                        	$newProfessor['Professor']['nome'] = $this->request->data['Professor']['nome'];
                        	$newProfessor['Professor']['turma_id'] = $this->request->data['Professor']['turma_id'];

                        	if(!$this->Professor->save($newProfessor)){
                        		$this->Usuario->delete($this->Usuario->id);
                        		$this->Session->setFlash('Ocorreu um erro ao tentar salvar o professor,as tente novamente', 'Flash/erro');
                        	}else{

	                            //envia email de boas vindas
	                            $Email = new CakeEmail();
	                            $Email->config('smtp')
	                                ->template('Usuario/novo', 'master')
	                                ->viewVars(array(
	                                    'nome_admin' => $this->Auth->user('nome'),
	                                    'nome' => $this->Usuario->nome,
                                        'usuario' => $this->Usuario->usuario,
	                                    'grupo' => 'Professores',
	                                    'senha'   => $senha,
	                                    'url'   =>  Configure::read('Site.url') . Router::url(array('controller' => 'usuarios', 'action' => 'entrar')),
	                                    'site'   => Configure::read('Site.nome')
	                                ))
	                                ->emailFormat('html')
	                                ->from(array( Configure::read('Site.email') => Configure::read('Sistema.nome')) )
	                                ->to($this->request->data['Professor']['email'])
	                                ->subject('Você foi cadastrado(a) no Sistema de Cursos da Igreja Videira');

	                            if($Email->send()){

	                                $this->Session->setFlash(__('Professor adicionado com sucesso'), 'Flash/sucesso');
	                                return $this->redirect(array('action' => 'index'));

	                            }else
	                                $this->Session->setFlash('Ocorreu um erro ao enviar o email para o novo professor, entre em contato manualmente', 'Flash/erro');

                        	}
                        }else{

                            if (!empty($this->Usuario->data['Usuario']['avatar']) && is_string($this->Contact->data['Professor']['avatar'])) {
                                $this->request->data['Professor']['avatar'] = $this->Usuario->data['Usuario']['avatar'];
                            }

                            $this->Session->setFlash('Ocorreu um erro ao tentar salvar os professor, tente novamente', 'Flash/erro');
                        }

                    }else
                         $this->Session->setFlash('Já existe um professor com esse email', 'Flash/erro');

                }else
                    $this->Session->setFlash('Já existe um professor com esse nome', 'Flash/erro');

            }else
                 $this->Session->setFlash('Confirmação de email incorreta', 'Flash/erro');

        }

       	$ra = $this->Professor->find('all', array(
       		'fields' => array("id"),
		  	'order' => array("id DESC")
			)
		);
		$result = $this->Professor->query("SELECT Auto_increment FROM information_schema.tables AS NextId  WHERE table_name='professores'");
		
    	$rp = $result[0]['NextId']['Auto_increment'];
    	$rp = 'RP' . str_pad($rp, 8, "0", STR_PAD_LEFT);
	
		$this->set('rp', $rp);
       
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function excluir() {
        $this->autoRender = false;

        if ($this->request->is('post')) {
            if($this->request->pass[0]){

                $professor = $this->Professor->findById($this->request->params['pass'][0]);
                $professor_id = $professor['Professor']['id'];
                $usuario_id = $professor['Usuario']['id'];
                $this->Professor->delete($professor_id);
                
                $modelUsuario = ClassRegistry::init('Usuario');
                $modelUsuario->id = $usuario_id;
                $modelUsuario->delete();
                
                $this->Session->setFlash('Professor removido com sucesso', 'Flash/sucesso');
            }else{
                $this->Session->setFlash('O professor não pode ser localizado', 'Flash/erro');
            }

        }

        $this->redirect(array('controller' => 'professores', 'action' => 'index'));
    }

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
    public function editar($id = null) {
        if (!$this->Professor->exists($id)) {
            throw new NotFoundException(__('Professor inválido'));
        }

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Professor->Usuario->save($this->request->data, array('fieldList' => array('Usuario' => array('nome', 'email', 'telefone', 'avatar'))))) {
                $this->Session->setFlash(__('Professor salvo com sucesso'), 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel salvar o professor, tente novamente'),  'Flash/erro');
            }
        } else {
            $options = array('conditions' => array('Professor.' . $this->Professor->primaryKey => $id));
            $this->request->data = $this->Professor->find('first', $options);
            $this->set('professor', $this->Professor->find('first', $options));
        }
    }

	/**
	 * change password method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
    public function senha($id = null) {
        if (!$this->Professor->exists($id)) {
            throw new NotFoundException(__('Professor inválido'));
        }

        $usuarioLogado = $this->Session->read('Auth.User');

        if ($this->request->is('post')){

            $options = array('conditions' => array('Professor.' . $this->Professor->primaryKey => $id));
            $professor = $this->Professor->find('first', $options);
            $senha = $professor['Usuario']['senha'];

            if(Security::hash($this->request->data['Professor']['senha_atual']) == $senha){

                if($this->request->data['Professor']['nova_senha'] === $this->request->data['Professor']['confirmar_senha']){

                    $this->Professor->Usuario->id = $usuario['Usuario']['id'];
                    $this->Professor->Usuario->saveField('senha', $this->request->data['Professor']['nova_senha']);
                    
                    $this->Cookie->delete('Usuario');

                    $this->Session->setFlash(__('Senha alterada com sucesso'), 'Flash/sucesso');
                    $this->redirect(array('action'=>'index'));
                
                }else
                    $this->Session->setFlash(__('Confirmação de senha incorreta'), 'Flash/erro');

            }else
                $this->Session->setFlash(__('Senha atual incorreta'), 'Flash/erro');
        }
    }

	/**
	 * gerar senha method
	 *
	 *
	 * @param int $length
	 * @return string
	 */
    private function gerar_senha( $length = 6 ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }

}