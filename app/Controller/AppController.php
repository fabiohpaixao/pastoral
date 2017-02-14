<?php

App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');
// App::uses('AppHelper', 'View/Helper');

class AppController extends Controller
{

    public $components = array(
        'Cookie',
        'Auth',
        'Session',
        'Security'
        //,'DebugKit.Toolbar'
    );

    public $helpers = array(
        'Form' => array(
            'className' => 'BootstrapForm'
        ),
        'Html',
        'Session' => array(
            'className' => 'BootstrapSession'
        ),
        'Paginator' => array(
            'className' => 'BootstrapPaginator'
        ),
        'Time',
        'CustomInputs',
        'Number'
    );

    public function beforeFilter(){ 

        $this->Auth_config();
        $this->Cookie_login();

        if($this->Auth->loggedIn()){

            if(!isset($this->Grupo))
                $this->loadModel('Grupo');

            if(!isset($this->Area))
                $this->loadModel('Area');

            if(!isset($this->Acesso))
                $this->loadModel('Acesso');

            $this->Load_menus();
            $this->Block_area();

        }

        if(in_array($this->params['controller'],array('propostas'))){
        // For RESTful web service requests, we check the name of our contoller
            $this->Auth->allow();
            // this line should always be there to ensure that all rest calls are secure
            /* $this->Security->requireSecure(); */
            $this->Security->unlockedActions = array('edit','delete','add','view');

        }else{
            // setup out Auth
            //$this->Auth->allow();         
        }
    }

    public function Block_area(){
        //bloqueia paginas
        if($this->params['controller'] !== "admin"){
            //var_dump($this->params['controller']);

            //carrega area de acordo com controller
            $options = array('conditions' => array('Area.chave' => $this->params['controller'] ));
            $area = $this->Area->find('first', $options);

            //carrega grupo do usuario
            $usuario = $this->Auth->user();
            $options = array('conditions' => array('Grupo.id' => $usuario['grupo_id'] ));
            $grupo = $this->Grupo->find('first', $options);

            if(empty($area))
                return false;

            $options = array('conditions' => array('Acesso.area_id' => $area['Area']['id'], 'Acesso.grupo_id' => $grupo['Grupo']['id'] ));
            $acesso = $this->Acesso->find('first', $options);
            
            if(empty($acesso)){
                if($this->params['controller'] !== "usuarios")
                    return $this->redirect(array('controller' => 'usuarios', 'action' => 'entrar'));
                    $this->Session->setFlash(__('Você não tem permissão para acessar essa área'), 'Flash/erro');
            }
            else{
            }

        }
    }

    public function Load_menus(){

        //carrega todos os pais
        $options = array('conditions' => array('Area.area_id = Area.id'), 'order' => array('Area.ordem ASC'));
        $menu = $this->Area->find('all', $options);
        
        //$menu = $this->Area->query("SELECT * FROM areas as Area where Area.area_id = Area.id ORDER BY Area.ordem ASC");

        for($i=0; $i < count($menu); $i++){
            //carrega todos os filhos
            $options = array('conditions' => array('AND' => array('Area.area_id' =>  $menu[$i]['Area']['id'], 'Area.area_id != Area.id')), 'order' => array('Area.ordem ASC'));

            $menu[$i]['Submenu'] = $this->Area->find('all', $options);


            //remove menus nao permitidos

            foreach ($menu[$i]['Submenu'] as $subkey => $submenu) {

                
                //carrega area de acordo com controller
                $options = array('conditions' => array('Area.chave' => $submenu['Area']['chave'] ));
                $area = $this->Area->find('first', $options);
                

                //carrega grupo do usuario
                $usuario = $this->Auth->user();
                $options = array('conditions' => array('Grupo.id' => $usuario['grupo_id'] ));
                $grupo = $this->Grupo->find('first', $options);


                $options = array('conditions' => array('Acesso.area_id' => $area['Area']['id'], 'Acesso.grupo_id' => $grupo['Grupo']['id'] ));
                $acesso = $this->Acesso->find('first', $options);
                
                // var_dump($acesso);

                if(!$acesso){
                    unset($menu[$i]['Submenu'][$subkey]);
                }
            }
        }
       

        $this->set('menus', $menu);
    }

    public function Cookie_login(){
        $cookie = $this->Cookie->read('Usuario');

        if ($cookie && !$this->Auth->loggedIn()) {

            $partes = explode(":", @stripslashes($cookie));
            if(!isset($this->Usuario))
                $this->loadModel('Usuario');
                $usuario = $this->Usuario->find('first', array('conditions'=>array('Usuario.usuario'=>$partes[0], 'Usuario.senha'=>$partes[1])));
            if($usuario){
                $this->Usuario->id = $usuario['Usuario']['id'];
                $this->Usuario->saveField('acesso', date('Y-m-d h:i:s'));
                $this->Auth->login($usuario['Usuario']);
            }

        }
    }

    public function Auth_config(){

        $usuarioLogado = $this->Session->read('Auth.User');

        $this->loadModel('Usuario', $usuarioLogado['id']);
        $usuarioLogado = $this->Usuario->read();
        
        $this->set('usuarioLogado', $usuarioLogado['Usuario']);

        $this->Auth->allow('esqueci', 'redefinir');

        // Action da tela de login
        $this->Auth->loginAction = array(
            'controller' => 'usuarios',
            'action' => 'entrar'
        );

        // Action da tela após o login (com sucesso)
        $this->Auth->loginRedirect = array(
            'controller' => 'admin',
            'action' => ''
        );

        // Action para redirecionamento após o logout
        $this->Auth->logoutRedirect = array(
            'controller' => 'usuario',
            'action' => 'entrar'
        );

        // Mensagens de erro
        $this->Auth->flash['element'] = 'Flash/erro';
        $this->Auth->authError = __('Você precisa fazer login para acessar esta página', true);
    }

    public function r_in_array($needle, $haystack, $strict = false){
        $found = false;

        foreach($haystack as $line){
            if(is_array($line))
                $this->r_in_array($needle, $line, $strict);
            else if($line == $needle){
                if($strict){
                    if(gettype($line) === gettype($needle))
                        $found = true;
                }else
                    $found = true;
            }
        }
        return $found;
    }


    public function Create_slug($string, $id = null) {
        $slug = Inflector::slug($string, '-');
        $slug = strtolower($slug);

        $i = 0;
        $params = array(
          'conditions' => array($this->modelClass .'.slug' => $slug), 
          'fields' => array($this->modelClass.'.id', $this->modelClass.'.slug'));

        if (!is_null($id)) 
          $params['conditions']['not'] = array($this->modelClass.'.id'=>$id);

        $modelClass = $this->modelClass;

        while (count($this->$modelClass->find('all', $params)))  {
          $i++;
          $params['conditions'][$this->modelClass . '.slug'] = $slug."-".$i;
        }
        if ($i) $slug .= "-".$i;

        return $slug;
    }


}
