<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 */
class AtividadesController extends AppController {

    public $components = array('RequestHandler');

    
    public function beforeFilter() 
    {
        parent::beforeFilter();
        $this->Security->unlockedActions = array('add', 'edit', 'delete');
    }

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
    public function index() {
        $usuario = $this->Auth->user();

        $this->loadModel('Disciplina');
        $this->Disciplina->create();
        
        //print_r($usuario);die();

        $options = ($usuario['grupo_id'] != Configure::read('Sistema.diretor_id') && $usuario['grupo_id'] != Configure::read('Sistema.administrador_id')) ? array('conditions' => array('usuario_id' =>  $usuario['id'])) : array();
        $this->Disciplina->recursive = 1;
        $disciplinas = $this->Disciplina->find('all', $options);

        //debug($disciplinas);       die();

        $turmas = array();
        foreach ($disciplinas as $key => $disciplina) {
            if(count($turmas) == 0)
                $turmas[] = $disciplina['Turma'];
            elseif(!in_array($disciplina['Turma'], $turmas)){
                $turmas[] = $disciplina['Turma'];
            }
        }

        $this->set('disciplinas', $disciplinas);
        $this->set('turmas', $turmas);
    }

/**
 * adicionar method
 *
 * @return void
**/
    public function add() {
        $atividade = $this->request->data;

        $this->Atividade->create();
        $this->Atividade->recursive = 0;

        if($this->Atividade->save($atividade)){
            $message = 'A atividade foi adicionada com sucesso!';
            $status = 200;
        } else {
            $message = 'Ops, ocorreu um erro ao adicionar atividade ';// . print_r($errors, true);
            $status = 500;// . print_r($errors, true);
        }

        $this->set(array(
            'message' => $message,
            'id' => $this->Atividade->id,
            'status' => $status,
            '_serialize' => array('message', 'id', 'status')
        ));
           
    }
    /**
     * adicionar method
     *
     * @return void
    **/
    public function edit($id) {
        $atividade = $this->request->data;

        $this->Atividade->id = $id;
        $this->Atividade->recursive = 0;
       
        if($this->Atividade->save($atividade)){
            $message = 'A atividade foi alterada com sucesso!';
            $status = 200;
        } else {
            $message = 'Ops, ocorreu um erro ao alterar atividade';
            $status = 500;
        }

        $this->set(array(
            'message' => $message,
            'id' => $this->Atividade->id,
            'status' => $status,
            '_serialize' => array('message', 'id', 'status')
        ));
           
    }

    public function delete($id) {
        if ($this->Atividade->delete($id)) {
            $message = 'A atividade foi deletada com sucesso!';
            $status = 200;
        } else {
            $message = 'Ops, ocorreu um erro ao deletar atividade';// . print_r($errors, true);
            $status = 500;
        }

        $this->set(array(
            'message' => $message,
            'status' => $status,
            '_serialize' => array('message', 'status')
        ));
    }

}
