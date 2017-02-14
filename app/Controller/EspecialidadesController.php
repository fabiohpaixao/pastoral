<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 */
class EspecialidadesController extends AppController {

	public $components = array('RequestHandler');  
/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

	public function beforeRender()  
	{  
	    if ($this->request->is('ajax')) {    
	        $this->layout = "ajax";    
	    }  
	} 

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
 * get_valores_json method
 *
 * @return void
 */
	function ajax_valores($ids){
		// $ids = '1,12,3';
		$especialidades = $this->Especialidade->find('list', array('recursive' => -1, 'fields'=>'valores', 'conditions' => array("id" => $ids)));
		foreach ($especialidades as $key => $value) $retorno = array('valor' => $value);
		$this->set(compact('retorno'));
		$this->render('ajax');
	}



/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function editar($id = null) {
        if (!$this->Especialidade->exists($id)) {
            throw new NotFoundException(__('Especialidade inválida'));
        }
		
		$this->Especialidade->id = $id;
        
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Especialidade->save($this->request->data)) {
                $this->Session->setFlash(__('Especialidade salva com sucesso'), 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel salvar o Especialidade, tente novamente'),  'Flash/erro');
            }
        } else {
            $options = array('conditions' => array('Especialidade.' . $this->Especialidade->primaryKey => $id));
            $this->request->data = $this->Especialidade->find('first', $options);
            $this->set('especialidade', $this->Especialidade->find('first', $options));

            // Lista colaborador
            $colaborador = $this->Especialidade->Colaborador->find('list');
            $this->set('colaboradores', $colaborador);
        }
    }

}
