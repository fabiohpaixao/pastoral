<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 */
class ColaboradoresController extends AppController {

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
 * adicionar method
 *
 * @return void
 */
    public function adicionar() {

        if ($this->request->is('post')){  

            //cria grupo
            $this->Colaborador->create();

            if ($this->Colaborador->save($this->request->data)) {
            	
                $this->Session->setFlash('Colaborador adicionado com sucesso', 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));
            }else
                $this->Session->setFlash('Ocorreu um erro ao tentar salvar o colaborador, tente novamente', 'Flash/erro');

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
        if (!$this->Colaborador->exists($id)) {
            throw new NotFoundException(__('Colaborador inválido'));
        }
		
		$this->Colaborador->id = $id;
        
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Colaborador->save($this->request->data)) {
                $this->Session->setFlash(__('Colaborador salvo com sucesso'), 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel salvar o colaborador, tente novamente'),  'Flash/erro');
            }
        } else {
            $options = array('conditions' => array('Colaborador.' . $this->Colaborador->primaryKey => $id));
            $this->request->data = $this->Colaborador->find('first', $options);
            $this->set('colaboradores', $this->Colaborador->find('first', $options));
        }
    }
}
