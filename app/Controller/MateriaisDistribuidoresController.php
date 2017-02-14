<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 */
class MateriaisDistribuidoresController extends AppController {

    public $components = array('RequestHandler');  

/**
 * ajax_valores method
 *
 * @return void
 */
    function ajax_valores($ids){

        $materiais = $this->Materialdistribuidor->find('list', array('recursive' => -1, 'fields'=>'valores', 'conditions' => array("id" => $ids)));
        foreach ($materiais as $key => $value) $retorno = array('valor' => $value);
        $this->set(compact('retorno'));
        $this->render('ajax');
    }

    function index(){
        // var_dump($this);exit();
    //     $retorno = $this->Materialdistribuidor->find('all');
    //     $this->set(compact('retorno'));
    }
}
