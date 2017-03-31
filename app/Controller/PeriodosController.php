<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 */
class PeriodosController extends AppController {

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
        $this->Periodo->recursive = 0;
        $this->set('periodos', $this->Periodo->find('all'));
    }
/**
 * adicionar method
 *
 * @return void
 */
    public function adicionar() {

        if ($this->request->is('post')){  

            //cria grupo
            $this->Periodo->create();

            if ($this->Periodo->save($this->request->data)) {
                
                $this->Session->setFlash('Periodo adicionado com sucesso', 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));
            }else
                $this->Session->setFlash('Ocorreu um erro ao tentar salvar o periodo letivo, tente novamente', 'Flash/erro');

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
        if (!$this->Periodo->exists($id)) {
            throw new NotFoundException(__('Periodo inválido'));
        }

        $this->Periodo->id = $id;
        
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Periodo->save($this->request->data)) {
                $this->Session->setFlash(__('Periodo salvo com sucesso'), 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel salvar o periodo letivo, tente novamente'),  'Flash/erro');
            }
        } else {
            $options = array('conditions' => array('Periodo.' . $this->Periodo->primaryKey => $id));
            $this->request->data = $this->Periodo->find('first', $options);
            $this->set('periodo', $this->Periodo->find('first', $options));
        }
    }
}
