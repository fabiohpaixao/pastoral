<?php
App::uses('AppController', 'Controller');
/**
 * Grupos Controller
 *
 * @property Grupo $Grupo
 */
class GruposController extends AppController {

    var $scaffold;

    function cria_acessos(){
        $this->loadModel('Acesso');
        $grupo_id = $this->Grupo->id;
        var_dump($this->data);
        foreach ($this->data['Grupo']['Area'] as $key => $value) {
            if($value){
                //cria acessos
                $options = array('conditions' => array('Area.chave' =>  $key));
                $area = $this->Area->find('first', $options);
                $area_id = $area['Area']['id'];

                $data = array(
                    'Acesso' => array(
                        'grupo_id' =>  $grupo_id,
                        'area_id' => $area_id
                    )
                );

                $this->Acesso->create();
                $this->Acesso->save($data);

            }
        }
    }

    function exclui_acessos($id){
        $this->loadModel('Acesso');
        $this->Acesso->deleteAll(array('Acesso.grupo_id' => $id));
    }

    function carrega_areas($grupo_id = null){
        //carrega areas pai
        //$options = array('conditions' => array('Area.area_id' => 0 ));
        $areas = $this->Area->find('all');

        for($i=0; $i < count($areas); $i++){
            //carrega areas filho
            $options = array('conditions' => array('Area.area_id' =>  $areas[$i]['Area']['id'] ));
            $areas[$i]['Check'] = $this->Area->find('all', $options);

            if($grupo_id){

                $this->loadModel('Acesso');
                $options = array('conditions' => array('Acesso.grupo_id' =>  $grupo_id ));
                $acessos = $this->Acesso->find('all', $options);

                foreach ($acessos as $ackey => $acesso) {

                    foreach ($areas[$i]['Check'] as $arkey => $area) {
                        if($acesso['Acesso']['area_id'] === $area["Area"]['id'])
                            $areas[$i]['Check'][$arkey]['Area']['checked'] = 1;

                    }

                }


             
            }

        }

        $this->set('areas', $areas);
    }


    public function adicionar() {

        $this->loadModel('Area');

        if ($this->request->is('post')){  

            //cria grupo
            $this->Grupo->create();

            if ($this->Grupo->save($this->request->data)) {

                $this->cria_acessos();

                $this->Session->setFlash('Grupo adicionado com sucesso', 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));

            }else
                $this->Session->setFlash('Ocorreu um erro ao tentar salvar o grupo, tente novamente', 'Flash/erro');

        }

        $this->carrega_areas();
    }

    public function editar($id = null) {
        if (!$this->Grupo->exists($id)) {
            throw new NotFoundException(__('Grupo inválido'));
        }

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Grupo->save($this->request->data)) {

                $this->exclui_acessos($id);
                $this->cria_acessos();

                $this->Session->setFlash(__('Grupo salvo com sucesso'), 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel salvar o grupo, tente novamente'),  'Flash/erro');
            }
        } else {
            $options = array('conditions' => array('Grupo.' . $this->Grupo->primaryKey => $id));
            $this->request->data = $this->Grupo->find('first', $options);
            $this->set('grupo', $this->Grupo->find('first', $options));
        }

        $this->carrega_areas($id);

    }

    public function excluir($id = null) {
        $this->Grupo->id = $id;
        if (!$this->Grupo->exists()) {
            throw new NotFoundException(__('Grupo inválido'));
        }
        $this->request->onlyAllow('post', 'delete');

        if ($this->Grupo->delete()) {

            $this->exclui_acessos($id);

            $this->Session->setFlash(__('Grupo excluido com sucesso'), 'Flash/sucesso');

        } else
            $this->Session->setFlash(__('Não foi possivel excluir o grupo, tente novamente'), 'Flash/erro');

        return $this->redirect(array('action' => 'index'));
    }

    public function visualizar($id = null) {
        if (!$this->Grupo->exists($id)) {
            throw new NotFoundException(__('Grupo inválido'));
        }
        $options = array('conditions' => array('Grupo.' . $this->Grupo->primaryKey => $id));
        $this->set('grupo', $this->Grupo->find('first', $options));

       $this->carrega_areas($id);
    }
}