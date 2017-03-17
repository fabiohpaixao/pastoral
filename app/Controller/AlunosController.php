<?php
App::uses('AppController', 'Controller');

/**
 * Alunos Controller
 *
 * @property Area $Area
 */
class AlunosController extends AppController {

    var $scaffold;

    /**
	 * index method
	 *
	 * @return void
	 */
    public function index() {

        $Email = new CakeEmail();
        $Email->config('smtp')
            ->template('Usuario/novo', 'master')
            ->viewVars(array(
                'nome_admin' => 'Euuu',
                'nome' => 'Fabio',
                'usuario' => 'user',
                'grupo' => 'Grupo',
                'senha'   => 'pass',
                'url'   =>  Configure::read('Site.url') . Router::url(array('controller' => 'usuarios', 'action' => 'entrar')),
                'site'   => Configure::read('Site.nome')
            ))
            ->emailFormat('html')
            ->from(array( Configure::read('Site.email') => Configure::read('Sistema.nome')) )
            ->to('vavarl1@gmail.com')
            ->subject('Você foi cadastrado(a) no Sistema de Cursos da Igreja Videira');

        $Email->send();

        $this->Aluno->recursive = 0;
        $this->set('alunos', $this->Aluno->find('all'));
    }

	/**
	 * add method
	 *
	 * @return void
	 */
	public function adicionar() {
		// Send a POST request with application/x-www-form-urlencoded encoded data
		if ($this->request->is('post')) {

            if($this->request->data['Aluno']['email'] == $this->request->data['Aluno']['confirmar_email']){

                //verifica se ja existe um usuario com o nome de usuario digitado
                $options = array('conditions' => array('Aluno.ra'=> $this->request->data['Aluno']['ra']));
                $AlunoExiste = $this->Aluno->find('first', $options);

                if(!$AlunoExiste){

                    //verifica se ja existe um usuario com o nome de email digitado
                    $options = array('conditions' => array('Usuario.email'=> $this->request->data['Aluno']['email']));
                    $EmailExiste = $this->Usuario->find('first', $options);

                    if(!$EmailExiste){

                        //cria usuario
                        $this->Usuario->create();

                        //gera senha aleatoria para usuario
                        $senha = $this->gerar_senha();
                        $this->Usuario->data['Usuario']['senha'] = $senha;

                        //data de criacao
                        $this->Usuario->set('criado', null);

                        $newUsuario['Usuario'] = $this->request->data['Aluno'];
                        $newUsuario['Usuario']['grupo_id'] = Configure::read('Sistema.aluno_id');
                        $newUsuario['Usuario']['usuario'] = $this->request->data['Aluno']['ra'];

                        if ($this->Usuario->save($newUsuario)) {

                        	$this->Aluno->create();
                        	$newAluno['Aluno']['usuario_id'] = $this->Usuario->id;
                        	$newAluno['Aluno']['ra'] =  $this->request->data['Aluno']['ra'];
                        	$newAluno['Aluno']['nome'] = $this->request->data['Aluno']['nome'];
                        	$newAluno['Aluno']['turma_id'] = $this->request->data['Aluno']['turma_id'];

                        	if(!$this->Aluno->save($newAluno)){
                        		$this->Usuario->delete($this->Usuario->id);
                        		$this->Session->setFlash('Ocorreu um erro ao tentar salvar o aluno,as tente novamente', 'Flash/erro');
                        	}else{

	                            //envia email de boas vindas
	                            $Email = new CakeEmail();
	                            $Email->config('gmail')
	                                ->template('Usuario/novo', 'master')
	                                ->viewVars(array(
	                                    'nome_admin' => $this->Auth->user('nome'),
	                                    'nome' => $this->request->data['Usuario']['nome'],
	                                    'usuario' => $this->request->data['Usuario']['usuario'],
	                                    'grupo' => 'Alunos',
	                                    'senha'   => $senha,
	                                    'url'   =>  Configure::read('Site.url') . Router::url(array('controller' => 'usuarios', 'action' => 'entrar')),
	                                    'site'   => Configure::read('Site.nome')
	                                ))
	                                ->emailFormat('html')
	                                ->from(array( Configure::read('Site.email') => Configure::read('Sistema.nome')) )
	                                ->to($this->request->data['Aluno']['email'])
	                                ->subject('Você foi cadastrado(a) no Sistema de Cursos da Igreja Videira');

	                            if($Email->send()){

	                                $this->Session->setFlash(__('Aluno adicionado com sucesso'), 'Flash/sucesso');
	                                return $this->redirect(array('action' => 'index'));

	                            }else
	                                $this->Session->setFlash('Ocorreu um erro ao enviar o email para o novo aluno, entre em contato manualmente', 'Flash/erro');

                        	}
                        }else{

                            if (!empty($this->Usuario->data['Usuario']['avatar']) && is_string($this->Contact->data['Aluno']['avatar'])) {
                                $this->request->data['Aluno']['avatar'] = $this->Usuario->data['Usuario']['avatar'];
                            }

                            $this->Session->setFlash('Ocorreu um erro ao tentar salvar os aluno, tente novamente', 'Flash/erro');
                        }

                    }else
                         $this->Session->setFlash('Já existe um aluno com esse email', 'Flash/erro');

                }else
                    $this->Session->setFlash('Já existe um aluno com esse nome', 'Flash/erro');

            }else
                 $this->Session->setFlash('Confirmação de email incorreta', 'Flash/erro');

        }

        $turmas = $this->Aluno->Turma->find('list',
            array(
                 'fields' => array(
                    'Turma.id',
                    'Turma.nome'
                )
            )
        );
        $this->set(compact('turmas'));

       	$ra = $this->Aluno->find('all', array(
       		'fields' => array("id"),
		  	'order' => array("id DESC")
			)
		);
		$result = $this->Aluno->query("SELECT Auto_increment FROM information_schema.tables AS NextId  WHERE table_name='alunos'");
    	$ra = $result[0]['NextId']['Auto_increment'];
    	$ra = 'RA' . str_pad($ra, 8, "0", STR_PAD_LEFT);
	
		$this->set('ra', $ra);
       
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

				$aluno = $this->Aluno->findById($this->request->params['pass'][0]);
				$aluno_id = $aluno['Aluno']['id'];
				$usuario_id = $aluno['Usuario']['id'];
				$this->Aluno->delete($aluno_id);
				
				$modelUsuario = ClassRegistry::init('Usuario');
				$modelUsuario->id = $usuario_id;
   				$modelUsuario->delete();
                
                $this->Session->setFlash('Aluno removido com sucesso', 'Flash/sucesso');
			}else{
				$this->Session->setFlash('O aluno não pode ser localizado', 'Flash/erro');
			}

		}

		$this->redirect(array('controller' => 'alunos', 'action' => 'index'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
    public function editar($id = null) {
        if (!$this->Aluno->exists($id)) {
            throw new NotFoundException(__('Aluno inválido'));
        }

        $turmas = $this->Aluno->Turma->find('list',
            array(
                 'fields' => array(
                    'Turma.id',
                    'Turma.nome'
                )
            )
        );
        $this->set(compact('turmas'));

        if ($this->request->is(array('post', 'put'))) {
			if ($this->Aluno->Usuario->save($this->request->data, array('fieldList' => array('Usuario' => array('nome', 'email', 'telefone', 'avatar'))))) {
				$this->Session->setFlash(__('Aluno salvo com sucesso'), 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Não foi possivel salvar o aluno, tente novamente'),  'Flash/erro');
			}
        } else {
            $options = array('conditions' => array('Aluno.' . $this->Aluno->primaryKey => $id));
            $this->request->data = $this->Aluno->find('first', $options);
            $this->set('aluno', $this->Aluno->find('first', $options));
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
        if (!$this->Aluno->exists($id)) {
            throw new NotFoundException(__('Aluno inválido'));
        }

        $usuarioLogado = $this->Session->read('Auth.User');

        if ($this->request->is('post')){

            $options = array('conditions' => array('Aluno.' . $this->Aluno->primaryKey => $id));
            $aluno = $this->Aluno->find('first', $options);
            $senha = $aluno['Usuario']['senha'];

            if(Security::hash($this->request->data['Aluno']['senha_atual']) == $senha){

                if($this->request->data['Aluno']['nova_senha'] === $this->request->data['Aluno']['confirmar_senha']){

                    $this->Aluno->Usuario->id = $usuario['Usuario']['id'];
                    $this->Aluno->Usuario->saveField('senha', $this->request->data['Aluno']['nova_senha']);
                    
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