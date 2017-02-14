<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 */
class DespesasController extends AppController {

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
    // public function index() {
    //     $this->Especialidade->recursive = 0;
    //     $this->set('especialidades', $this->Especialidade->find('all'));
    // }


/**
 * add method
 *
 * @return void
 */
    public function adicionar() {

        if ($this->request->is('post')) {
            //cria grupo
            $this->Despesa->create();

            if ($this->Despesa->save($this->request->data)) {

                $this->Session->setFlash('Despesa adicionada com sucesso', 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));

            }else
                $this->Session->setFlash('Ocorreu um erro ao tentar salvar a despesa, tente novamente', 'Flash/erro');

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
        if (!$this->Despesa->exists($id)) {
            throw new NotFoundException(__('Despesa inválida'));
        }
        
        $this->Despesa->id = $id;
        
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Despesa->save($this->request->data)) {
                $this->Session->setFlash(__('Despesa salva com sucesso'), 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel salvar a despesa, tente novamente'),  'Flash/erro');
            }
        } else {
            $options = array('conditions' => array('Despesa.' . $this->Despesa->primaryKey => $id));
            $this->request->data = $this->Despesa->find('first', $options);
            $this->set('despesas', $this->Despesa->find('first', $options));
        }
    }

/**
 * ajax_valores method
 *
 * @return void
 */
    function ajax_valores($ids){
        // $ids = '1,12,3';
        $despesas = $this->Despesa->find('list', array('recursive' => -1, 'fields'=>'valores', 'conditions' => array("id" => $ids)));
        foreach ($despesas as $key => $value) $retorno = array('valor' => $value);
        $this->set(compact('retorno'));
        $this->render('ajax');
    }
}
