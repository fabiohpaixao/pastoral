<?php
App::uses('AppController', 'Controller');
/**
 * Areas Controller
 *
 * @property Area $Area
 */
class PropostasController extends AppController {

	public $components = array('RequestHandler');  

    public function index() {
        $propostas = $this->Proposta->find('all');
        $this->set(array(
            'propostas' => $propostas,
            '_serialize' => array('propostas')
        ));
    }

    public function view($id) {
        $proposta = $this->Proposta->findById($id);
        $this->set(array(
            'proposta' => $proposta,
            '_serialize' => array('proposta')
        ));
    }

    public function add() {
        //$this->Proposta->id = $id;
        if ($this->Proposta->save($this->request->data)) {
            $message = array(
                'text' => __('Salvo'),
                'type' => 'success'
            );
        } else {
            $message = array(
                'text' => __('Error'),
                'type' => 'error'
            );
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

    public function edit($id) {
        $this->Proposta->id = $id;
        if ($this->Proposta->save($this->request->data)) {
            $message = array(
                'text' => __('Salvo'),
                'type' => 'success'
            );
        } else {
            $message = array(
                'text' => __('Error'),
                'type' => 'error'
            );
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

    public function delete($id) {
        if ($this->Proposta->delete($id)) {
            $message = array(
                'text' => __('Deletado'),
                'type' => 'success'
            );
        } else {
            $message = array(
                'text' => __('Error'),
                'type' => 'error'
            );
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

}
