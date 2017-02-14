<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 */
class NotasFiscaisController extends AppController {

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
            $this->NotasFiscais->create();

            if ($this->NotasFiscais->save($this->request->data)) {
            	
                $this->Session->setFlash('Nota Fiscal adicionada com sucesso', 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));
            }else
                $this->Session->setFlash('Ocorreu um erro ao tentar salvar a nota, tente novamente', 'Flash/erro');

        }
        

        // // Lista clientes
        // $notasfiscais = $this->Boleto->NotaFiscal->find('list');
        // // debug($notasfiscais);die();
        // $this->set('notasfiscais', $notasfiscais);
        $status = array(0 => 'OK', 1 => 'PENDENTE');
        $this->set('status', $status);

    }


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
 /*   public function editar($id = null) {
        if (!$this->Cliente->exists($id)) {
            throw new NotFoundException(__('Cliente inválido'));
        }
		
		$this->Cliente->id = $id;
        
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Cliente->save($this->request->data)) {
                $this->Session->setFlash(__('Cliente salvo com sucesso'), 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel salvar o Cliente, tente novamente'),  'Flash/erro');
            }
        } else {
            $options = array('conditions' => array('Cliente.' . $this->Cliente->primaryKey => $id));
            $this->request->data = $this->Cliente->find('first', $options);
            $this->set('clientes', $this->Cliente->find('first', $options));
        }
    }
    */
}
