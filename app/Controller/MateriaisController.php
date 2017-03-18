<?php
App::uses('AppController', 'Controller');
/**
 * Areas Controller
 *
 * @property Area $Area
 */
class MateriaisController extends AppController {

    var $scaffold;

    /**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->Material->recursive = 2;
        $materiais = $this->Material->find('all');
        $this->set('materiais', $materiais);
    }


/**
 * add method
 *
 * @return void
 */

    public function adicionar() {

        if ($this->request->is('post')) {
            //cria grupo
            $this->Material->create();

            if ($this->Material->save($this->request->data)) {

                $this->Session->setFlash('Material adicionada com sucesso', 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));

            }else{
                debug($this->request->data);
                $this->Session->setFlash('Ocorreu um erro ao tentar salvar a material, tente novamente' , 'Flash/erro');
            }

        }else{
            $disciplinas = $this->Material->Disciplina->find('list');
            
            if(count($disciplinas) < 1 ){
                $this->Session->setFlash(__('Primeiro cadastre uma disciplina'), 'Flash/erro');
               return $this->redirect(array('action' => 'index'));
            }
            
            $this->set('disciplinas', $disciplinas);

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
        if (!$this->Material->exists($id)) {
            $this->Session->setFlash(__('Material nao encontrado'), 'Flash/erro');
            return $this->redirect(array('action' => 'index'));
        }
        
        $this->Material->id = $id;
        
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Material->save($this->request->data)) {
                $this->Session->setFlash(__('Material salvo com sucesso'), 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel salvar o material, tente novamente'),  'Flash/erro');
            }
        } else {
            $options = array('conditions' => array('Material.' . $this->Material->primaryKey => $id));
            $this->request->data = $this->Material->find('first', $options);
            $this->set('materiais', $this->Material->find('first', $options));

            $disciplinas = $this->Material->Disciplina->find('list');
            
            if(count($disciplinas) < 1 ){
                $this->Session->setFlash(__('Primeiro cadastre uma disciplina'), 'Flash/erro');
                return $this->redirect(array('action' => 'index'));
            }
            $this->set('disciplinas', $disciplinas);
        }
    }

/**
 * ajax_valores method
 *
 * @return void
 */
    function ajax_valores($ids){
        // $ids = '1,12,3';
        $materiais = $this->Material->find('list', array('recursive' => -1, 'fields'=>'valores', 'conditions' => array("id" => $ids)));
        foreach ($materiais as $key => $value) $retorno = array('valor' => $value);
        $this->set(compact('retorno'));
        $this->render('ajax');
    }

}
