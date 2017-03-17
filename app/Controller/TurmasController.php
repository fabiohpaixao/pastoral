<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 */
class TurmasController extends AppController {

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
 
    public function index() {
        $this->Post->recursive = 0;
        $this->set('posts', $this->Post->find('all'));
    }
*/
/**
 * adicionar method
 *
 * @return void
 */
    public function adicionar() {

        if ($this->request->is('post')){  

            //cria grupo
            $this->Turma->create();

            if ($this->Turma->save($this->request->data)) {
                
                $this->Session->setFlash('Turma adicionado com sucesso', 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));
            }else
                $this->Session->setFlash('Ocorreu um erro ao tentar salvar o turma letivo, tente novamente', 'Flash/erro');

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
        if (!$this->Turma->exists($id)) {
            throw new NotFoundException(__('Turma inválido'));
        }

        $this->Turma->id = $id;
        
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Turma->save($this->request->data)) {
                $this->Session->setFlash(__('Turma salvo com sucesso'), 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel salvar o turma letivo, tente novamente'),  'Flash/erro');
            }
        } else {
            $options = array('conditions' => array('Turma.' . $this->Turma->primaryKey => $id));
            $this->request->data = $this->Turma->find('first', $options);
            $this->set('turma', $this->Turma->find('first', $options));
        }
    }
}
