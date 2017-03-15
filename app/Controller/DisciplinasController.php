<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 */
class DisciplinasController extends AppController {

    public $components = array('RequestHandler');  
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
        $this->Disciplina->recursive = 2;
        $disciplinas = $this->Disciplina->find('all');
        $this->set('disciplinas', $disciplinas);
    }


/**
 * add method
 *
 * @return void
 */

    public function adicionar() {

        if ($this->request->is('post')) {
            //cria grupo
            $this->Disciplina->create();

            if ($this->Disciplina->save($this->request->data)) {

                $this->Session->setFlash('Disciplina adicionada com sucesso', 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));

            }else{
                debug($this->request->data);
                $this->Session->setFlash('Ocorreu um erro ao tentar salvar a disciplina, tente novamente' , 'Flash/erro');
            }

        }else{
            $turmas = $this->Disciplina->Turma->find('list');
            $this->set('turmas', $turmas);

            $professores = $this->Disciplina->Professor->find('list', array('recursive' => 1, 'fields' => 'Professor.id, Usuario.nome'));
            
            
            if(count($professores) < 1 ){
                $this->Session->setFlash(__('Primeiro cadastre um professor'), 'Flash/erro');
               return $this->redirect(array('action' => 'index'));
            }
            
            $this->set('professores', $professores);
        }
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

    public function editar($id = null) {
        if (!$this->Disciplina->exists($id)) {
            $this->Session->setFlash(__('Disciplina nao encontrada'), 'Flash/erro');
            return $this->redirect(array('action' => 'index'));
        }
        
        $this->Disciplina->id = $id;
        
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Disciplina->save($this->request->data)) {
                $this->Session->setFlash(__('Disciplina salva com sucesso'), 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel salvar a disciplina, tente novamente'),  'Flash/erro');
            }
        } else {
            $options = array('conditions' => array('Disciplina.' . $this->Disciplina->primaryKey => $id));
            $this->request->data = $this->Disciplina->find('first', $options);
            $this->set('disciplinas', $this->Disciplina->find('first', $options));

            $turmas = $this->Disciplina->Turma->find('list');
            $this->set('turmas', $turmas);
            
            $professores = $this->Disciplina->Professor->find('list', array('recursive' => 1, 'fields' => 'Professor.id, Usuario.nome'));
            
            if(count($professores) < 1 ){
                $this->Session->setFlash(__('Primeiro cadastre um professor'), 'Flash/erro');
                return $this->redirect(array('action' => 'index'));
            }
            //debug($turmas);die();
            $this->set('professores', $professores);
        }
    }

/**
 * ajax_valores method
 *
 * @return void
 */
    function ajax_valores($ids){
        // $ids = '1,12,3';
        $disciplinas = $this->Disciplina->find('list', array('recursive' => -1, 'fields'=>'valores', 'conditions' => array("id" => $ids)));
        foreach ($disciplinas as $key => $value) $retorno = array('valor' => $value);
        $this->set(compact('retorno'));
        $this->render('ajax');
    }
}
