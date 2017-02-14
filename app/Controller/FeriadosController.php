<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 */
class FeriadosController extends AppController {

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
            $this->Feriado->create();

            if ($this->Feriado->save($this->request->data)) {
            	
                $this->Session->setFlash('Feriado adicionado com sucesso', 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));
            }else
                $this->Session->setFlash('Ocorreu um erro ao tentar salvar o feriado, tente novamente', 'Flash/erro');

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
        if (!$this->Feriado->exists($id)) {
            throw new NotFoundException(__('Feriado inválido'));
        }

        $this->Feriado->id = $id;
        
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Feriado->save($this->request->data)) {
                $this->Session->setFlash(__('Feriado salvo com sucesso'), 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel salvar o feriado, tente novamente'),  'Flash/erro');
            }
        } else {
            $options = array('conditions' => array('Feriado.' . $this->Feriado->primaryKey => $id));
            $this->request->data = $this->Feriado->find('first', $options);
            $this->set('feriado', $this->Feriado->find('first', $options));
        }
    }


}
