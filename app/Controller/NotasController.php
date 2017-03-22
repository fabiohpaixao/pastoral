<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 */
class NotasController extends AppController {

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
        
        $options = array('conditions' => array('usuario_id' =>  $usuario['id']));
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
        $notas = $this->request->data;

        $dataSource = $this->Nota->getDataSource();

        //debug($notas['Nota']); die();
        
        $dataSource->begin();
        
        try {

            foreach ($notas['Nota'] as $nota) {

                $this->Nota->id = $nota['id'];
                $this->Nota->atividade_id = $nota['atividade_id'];
                $this->Nota->valor = $nota['valor'];
                $this->Nota->aluno_id = $nota['aluno_id'];
                $this->Nota->recursive = 0;
                                
                if(!$this->Nota->save())
                   throw new Exception("Error Processing Request");

            }

            $dataSource->commit();
            $message = 'A nota foi adicionada com sucesso!';
            $status = 200;
        } catch (Exception $e) {
            $dataSource->rollback();
            $message = 'Ops, ocorreu um erro ao adicionar nota ';// . print_r($errors, true);
            $status = 500;// . print_r($errors, true);
        }


        $this->set(array(
            'message' => $message,
            'status' => $status,
            '_serialize' => array('message', 'status')
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
            $status = 500;
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
