<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 */
class FrequenciasController extends AppController {

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
        
        $options = ($usuario['grupo_id'] != Configure::read('Sistema.diretor_id') && $usuario['grupo_id'] != Configure::read('Sistema.administrador_id')) ? array('conditions' => array('usuario_id' =>  $usuario['id'])) : array();
        $this->Disciplina->recursive = 1;
        $disciplinas = $this->Disciplina->find('all', $options);

        $turmas = array();
        foreach ($disciplinas as $key => $disciplina) {
            if(count($turmas) == 0)
                $turmas[] = $disciplina['Turma'];
            elseif(!in_array($disciplina['Turma'], $turmas)){
                $turmas[] = $disciplina['Turma'];
            }
        }

        $options = array('fields' => array('id', 'data', 'disciplina_id'), 'order' => array('data ASC'), "group" => array('disciplina_id', 'data'));
        $aulas = $this->Frequencia->find('list', $options);

       // debug($aulas); die();
        $this->set('disciplinas', $disciplinas);
        $this->set('turmas', $turmas);
        $this->set('aulas', $aulas);


        $this->loadModel('Aluno');

        $alunos = $this->Aluno->find('threaded' , array('recursive' => 1, 'fields' => array('id', 'ra', 'turma_id', 'Usuario.nome'), 'order' => 'turma_id, Usuario.nome'));
        //debug($alunos);       die();
        $this->set('alunos', $alunos);

    }

/**
 * adicionar method
 *
 * @return void
**/
    public function add() {
        $frequencias = $this->request->data;
        //debug($frequencias); die();
        
        $novaFrequencia = array();
        
        foreach ($frequencias['Frequencia']['presenca'] as $frequencia) {
            if(!$frequencia) continue;
            $nova['Frequencia']['data'] = date('Y-m-d', strtotime($frequencias['Frequencia']['data']));
            $nova['Frequencia']['disciplina_id'] = $frequencias['Frequencia']['disciplina_id'];
            $nova['Frequencia']['aluno_id'] = $frequencia;
            $nova['Frequencia']['presenca'] = 1;
            $novaFrequencia[] = $nova;
        }
        //debug($novaFrequencia); die();
        if($this->Frequencia->saveMany($novaFrequencia)){
            $this->Session->setFlash('Frequência adicionada com sucesso', 'Flash/sucesso');
        }else
            $this->Session->setFlash('Ocorreu um erro ao tentar salvar a frequência, tente novamente', 'Flash/erro');

        return $this->redirect(array('controller' => 'frequencias','action' => 'index'));
   
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

   /* public function delete($id) {
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
    }*/

}
