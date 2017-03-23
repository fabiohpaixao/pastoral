<?php

App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');

class UsuariosController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator');
    
    public $name = 'Usuarios';

    public $scaffold;

    public function entrar() {

        //echo $this->Auth->password('teste');
        ///echo Security::hash('fabioh', 'sha1', false);
        //die();
        $this->layout = 'login';

        if (!$this->request->is('post')) {

            if($this->Auth->loggedIn()) return $this->redirect($this->Auth->redirect());

        }else {

            //debug($this->Auth->login()); die();

            if(!$this->Auth->login()){ 
                $this->Session->setFlash('Usuário e/ou senha incorreto(s)', 'Flash/erro');
                return;
            }else{

                $options = array('conditions' => array('Usuario.usuario'=> $this->data['Usuario']['usuario']));
                $usuario = $this->Usuario->find('first', $options);

                $this->Usuario->id = $this->Auth->user('id');

                $this->Usuario->saveField('acesso', date('Y-m-d h:i:s'));
                $this->Session->setFlash('Bem vindo ' . $usuario['Usuario']['nome'], 'Flash/sucesso');

                if (!$this->data['Usuario']['lembrar']) {
                    $this->Cookie->delete('Usuario');
                }else {

                    $hash = $usuario['Usuario']['usuario'].':'.$usuario['Usuario']['senha'];
                    $this->Cookie->write('Usuario', $hash, false, '+2 weeks');

                }

                return $this->redirect($this->Auth->redirect());
            }

        }
    }

    public function sair() {

        $this->Cookie->delete('Usuario');

        $this->Session->destroy();
        $this->Session->setFlash('Você saiu do painel', 'Flash/sucesso');

        return $this ->Redirect(array('controller' => 'usuarios','action' => 'entrar'));
        exit();
    }

    public function esqueci() {
        $this->layout = 'login';

        if ($this->request->is('post')) {

            $options = array('conditions' => array('Usuario.email'=> $this->data['Usuario']['email']));
            $usuario = $this->Usuario->find('first', $options);

            if(!$usuario){
                $this->Session->setFlash('Não existe um usuário com este email', 'Flash/erro');
                return;
            }

            if(!$usuario['Usuario']['ativo']){
                $this->Session->setFlash('Está usuário não está ativo no momento', 'Flash/erro');
                return;
            }


            $token = Security::hash(String::uuid(),'sha1',true);
            $url = Configure::read('Site.url') . Router::url(array('controller' => 'usuarios', 'action' => 'redefinir')) .'/'.
                   $usuario['Usuario']['id'] . '/' .
                   $token;

            $Email = new CakeEmail();
            $Email->config('smtp')
                ->template('Usuario/esqueci', 'master')
                ->viewVars(array(
                    'nome' => $usuario['Usuario']['nome'],
                    'url'   => $url,
                ))
                ->emailFormat('html')
                ->from(array( Configure::read('Site.email') => Configure::read('Sistema.nome')) )
                ->to($usuario['Usuario']['email'])
                ->subject('Redefinição de senha');

            if(!$Email->send()){
                $this->Session->setFlash('Ocorreu um erro ao enviar o email, tente novamente', 'Flash/erro');
                return;
            }

            $this->Usuario->id = $usuario['Usuario']['id'];
            $this->Usuario->saveField('token', $token);

            $date = date("Y-m-d h:i:s", time() + (86400)); 
            $this->Usuario->saveField('token_expira', $date);

            $this->Session->setFlash('Um link para redifinição de senha foi enviado para ' . $this->data['Usuario']['email'], 'Flash/sucesso');
            
            return $this->Redirect(array('controller' => 'usuarios','action' => 'entrar'));
        }
    }

    public function redefinir($id = null, $token = null) {
        $this->layout = 'login';

        if (!$this->request->is(array('get', 'post'))) {

            $this->Session->setFlash('Você precisa de uma chave para redefinir sua senha', 'Flash/erro');
            
            return $this->Redirect(array('controller' => 'usuarios','action' => 'entrar'));

        }else{

            $options = array('conditions' => array('Usuario.token'=> $token, 'Usuario.id'=> $id, 'Usuario.token_expira >=' =>   date("Y-m-d h:i:s")));
            $usuario = $this->Usuario->find('first', $options);

            if(!$usuario){
                $this->Session->setFlash('A redifinição de senha para este usuário não existe ou expirou', 'Flash/erro');
                
                return $this->Redirect(array('controller' => 'usuarios','action' => 'entrar'));
            }

            // checa data de expiração

            if ($this->request->is('post')) {

                $this->Usuario->id = $usuario['Usuario']['id'];
                $senha = $this->data['Usuario']['senha'];

                $this->Usuario->saveField('senha', $senha);
                $this->Usuario->saveField('token', null);
                $this->Usuario->saveField('token_expira', null);

                $this->Session->setFlash('Senha alterada com sucesso', 'Flash/sucesso');
                return $this->Redirect(array('controller' => 'usuarios','action' => 'entrar'));

            }
        }
    }

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->Usuario->recursive = 0;
        $this->set('usuarios', $this->Usuario->find('all'));
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function visualizar($id = null) {
        if (!$this->Usuario->exists($id)) {
            throw new NotFoundException(__('Usuário inválido'));
        }

        $options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
        $this->set('usuario', $this->Usuario->find('first', $options));
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

/**
 * add method
 *
 * @return void
 */
    public function adicionar() {

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
                            $Email->config('smtp')
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
                                return $this->Redirect(array('controller' => 'usuarios','action' => 'index'));

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

        $grupos = $this->Usuario->Grupo->find('list',
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

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function editar($id = null) {
        if (!$this->Usuario->exists($id)) {
            throw new NotFoundException(__('Usuário inválido'));
        }

        $grupos = $this->Usuario->Grupo->find('list',
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

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash(__('Usuário salvo com sucesso'), 'Flash/sucesso');
                return $this->Redirect(array('controller' => 'usuarios','action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel salvar o usuário, tente novamente'),  'Flash/erro');
            }
        } else {
            $options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
            $this->request->data = $this->Usuario->find('first', $options);
            $this->set('usuario', $this->Usuario->find('first', $options));
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
        if (!$this->Usuario->exists($id)) {
            throw new NotFoundException(__('Usuário inválido'));
        }

        $usuarioLogado = $this->Session->read('Auth.User');

        if ($this->request->is('post')){

            $options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
            $usuario = $this->Usuario->find('first', $options);
            $senha = $usuario['Usuario']['senha'];

            if(Security::hash($this->request->data['Usuario']['senha_atual']) == $senha){

                if($this->request->data['Usuario']['nova_senha'] === $this->request->data['Usuario']['confirmar_senha']){

                    $this->Usuario->id = $usuario['Usuario']['id'];
                    $this->Usuario->saveField('senha', $this->request->data['Usuario']['nova_senha']);
                    
                    $this->Cookie->delete('Usuario');

                    $this->Session->setFlash(__('Senha alterada com sucesso'), 'Flash/sucesso');
                    return $this->Redirect(array('controller' => 'usuarios','action' => 'index'));
                
                }else
                    $this->Session->setFlash(__('Confirmaçãa de senha incorreta'), 'Flash/erro');

            }else
                $this->Session->setFlash(__('Senha atual incorreta'), 'Flash/erro');
        }
    }

}

?>