<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 */
class MateriaisController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

/**
 * index method
 *
 * @return void
 */
    // public function index() {
    //     $this->Especialidade->recursive = 0;
    //     $this->set('especialidades', $this->Especialidade->find('all'));
    // }

/**
 * add method
 *
 * @return void
 */
    public function adicionar() {

        if ($this->request->is('post')){ 

            // var_dump($this->Material);
            // die();
            //cria material
            $this->Material->create();

            if ($this->Material->save($this->request->data)) {
                
                //Fazendo relação do material com o distribuidor
                $this->loadModel('MaterialDistribuidor');
                $this->MaterialDistribuidor->create();
                $this->MaterialDistribuidor->set('material_id', $this->Material->id);
                $this->MaterialDistribuidor->set('valor', $this->request->data['Distribuidor']['valor']);
                $this->MaterialDistribuidor->set('distribuidor_id', $this->request->data['Distribuidor']['id']);

                if($this->MaterialDistribuidor->save()) {
                    $this->Session->setFlash('Material adicionado com sucesso', 'Flash/sucesso');
                    return $this->redirect(array('action' => 'index'));
                }else{
                    $this->Material->delete($this->Material->id);
                    $this->Session->setFlash('Ocorreu um erro ao tentar salvar o material, tente novamente', 'Flash/erro');
                }
            }else
                $this->Session->setFlash('Ocorreu um erro ao tentar salvar o material, tente novamente', 'Flash/erro');
        }

        //carrega o model
        $this->loadModel('Distribuidor');
        $this->set('distribuidores', $this->Distribuidor->find('list'));
        
        // $this->set('distribuidores', $this->Distribuidor->find('all'));
    }


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function editar($id = null) {
        if (!$this->Material->exists($id)) {
            throw new NotFoundException(__('Material inválido'));
        }

        $this->Material->id = $id;

        $this->loadModel('MaterialDistribuidor');
        $materialDistribuidor = $this->MaterialDistribuidor->find('all',
            array(
                'conditions' => array('MaterialDistribuidor.material_id' => $id)
            )
        );

        $this->set(compact('materialDistribuidor'));
        // var_dump($materialDistribuidor);die();

        if ($this->request->is(array('post', 'put'))) {

            if ($this->Material->save($this->request->data)) {

                $this->loadModel('MaterialDistribuidor');
                $this->MaterialDistribuidor->deleteAll(array('material_id' => $this->Material->id), false);
                
                $this->MaterialDistribuidor->create();
                $this->MaterialDistribuidor->set('material_id', $this->Material->id);
                $this->MaterialDistribuidor->set('valor', $this->request->data['Distribuidor']['valor']);
                $this->MaterialDistribuidor->set('distribuidor_id', $this->request->data['Distribuidor']['id']);

                if($this->MaterialDistribuidor->save()) {
                    $this->Session->setFlash(__('Material salvo com sucesso'), 'Flash/sucesso');
                    return $this->redirect(array('action' => 'index'));
                }else{
                     $this->Session->setFlash(__('Não foi possivel salvar o material, tente novamente'),  'Flash/erro');
                }
            } else {
                $this->Session->setFlash(__('Não foi possivel salvar o material, tente novamente'),  'Flash/erro');
            }
        } else {
            $options = array('conditions' => array('Material.' . $this->Material->primaryKey => $id));
            $this->request->data = $this->Material->find('first', $options);

            $this->set('material', $this->Material->find('first', $options));


            //carrega o model
            $this->loadModel('Distribuidor');
            $this->set('distribuidores', $this->Distribuidor->find('list'));

            // $this->MaterialDistribuidor->
        }
    }

    public function adicionar2() {

        if ($this->request->is('post')) {

            if($this->request->data['Usuario']['email'] == $this->request->data['Usuario']['confirmar_email']){

                //verifica se ja existe um usuario com o nome de usuario digitado
                $options = array('conditions' => array('Usuario.usuario'=> $this->request->data['Usuario']['usuario']));
                $UsuarioExiste = $this->Usuario->find('first', $options);

                if(!$UsuarioExiste){

                    //verifica se ja existe um usuario com o nome de email digitado
                    $options = array('conditions' => array('Usuario.email'=> $this->request->data['Usuario']['email']));
                    $EmailExiste = $this->Usuario->find('first', $options);

                    if(!$EmailExiste){

                        //cria usuario
                        $this->Usuario->create();

                        //gera senha aleatoria para usuario
                        $senha = $this->gerar_senha();
                        $this->Usuario->data['Usuario']['senha'] = $senha;

                        //data de criacao
                        $this->Usuario->set('criado', null);

                        if ($this->Usuario->save($this->request->data)) {

                            //carrega nome do grupo
                            $this->loadModel('Grupo');
                            $options = array('conditions' => array('Grupo.id'=> $this->request->data['Usuario']['Grupo']));
                            $grupo = $this->Grupo->find('first', $options);

                            //envia email de boas vindas
                            $Email = new CakeEmail();
                            $Email->config('gmail')
                                ->template('Usuario/novo', 'master')
                                ->viewVars(array(
                                    'nome_admin' => $this->Auth->user('nome'),
                                    'nome' => $this->request->data['Usuario']['nome'],
                                    'usuario' => $this->request->data['Usuario']['usuario'],
                                    'grupo' => $grupo['Grupo']['nome'],
                                    'senha'   => $senha,
                                    'url'   =>  Configure::read('Site.url') . Router::url(array('controller' => 'usuarios', 'action' => 'entrar')),
                                    'site'   => Configure::read('Site.nome')
                                ))
                                ->emailFormat('html')
                                ->from(array( Configure::read('Site.email') => Configure::read('Sistema.nome')) )
                                ->to($this->request->data['Usuario']['email'])
                                ->subject('Você foi cadastrado(a) no Sistema de Cursos da Igreja Videira');

                            if($Email->send()){

                                $this->Session->setFlash(__('Usuário adicionado com sucesso'), 'Flash/sucesso');
                                return $this->redirect(array('action' => 'index'));

                            }else
                                $this->Session->setFlash('Ocorreu um erro ao enviar o email para o novo usuário, entre em contato manualmente', 'Flash/erro');

                        }else
                            if (!empty($this->Usuario->data['Usuario']['avatar']) && is_string($this->Contact->data['Usuario']['avatar'])) {
                                $this->request->data['Usuario']['avatar'] = $this->Usuario->data['Usuario']['avatar'];
                            }

                            $this->Session->setFlash('Ocorreu um erro ao tentar salvar o usuário, tente novamente', 'Flash/erro');

                    }else
                         $this->Session->setFlash('Já existe um usuário com esse email', 'Flash/erro');

                }else
                    $this->Session->setFlash('Já existe um usuário com esse nome', 'Flash/erro');

            }else
                 $this->Session->setFlash('Confirmação de email incorreta', 'Flash/erro');

        }

        $grupos = $this->Fabricante->find('list',
            array(
                'conditions' => array(
                    'NOT' => array('Grupo.nome' => 'Kadmin')
                ),
                 'fields' => array(
                    'Grupo.id',
                    'Grupo.nome'
                )
            )
        );

        $this->set(compact('grupos'));
    }
}
