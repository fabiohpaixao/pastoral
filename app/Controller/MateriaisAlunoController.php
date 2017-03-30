<?php
App::uses('AppController', 'Controller');
/**
 * Areas Controller
 *
 * @property Area $Area
 */
class MateriaisAlunoController extends AppController {

    var $scaffold;

    /**
 * index method
 *
 * @return void
 */
    public function index() {
        $usuario = $this->Auth->user();
        
        $this->loadModel('Aluno');
        $this->Aluno->create();

        $options = array('conditions' => array('usuario_id' =>  $usuario['id']));
        $this->Aluno->recursive = 0;
        $aluno = $this->Aluno->find('first', $options);

        $this->loadModel('Turma');
        $this->Turma->create();

        $options = array('conditions' => array('id' =>  $aluno['Aluno']['turma_id']));//, 'ativa' => 1));
        $this->Turma->recursive = -1;
        $turmas = $this->Turma->find('all', $options);
        $this->set('turmas', $turmas);

        $this->loadModel('Disciplina');
        $this->Disciplina->create();

        $this->Disciplina->recursive = -1;
        $disciplinas = $this->Disciplina->find('all');
        $this->set('disciplinas', $disciplinas);

        $this->loadModel('Material');
        $this->Material->create();

        $this->Material->recursive = -1;
        $materiais = $this->Material->find('all');
        $this->set('materiais', $materiais);


        
        //debug($materiais);die();
    }


    /**
     * Download do material
     *
     * @param int $id
     * @return void
     */
    public function download($id){
        $this->loadModel('Material');
        $this->Material->create();

        $material = $this->Material->findById($id);

        //debug($material);die();
        $this->response->file($material['Material']['arquivo'], array(
            'download' => true,
            'name' => basename($material['Material']['arquivo']),
        ));
        return $this->response;
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
