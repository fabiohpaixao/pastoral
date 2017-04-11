<?php

App::uses('AppController', 'Controller');

class RelatoriosController extends AppController
{
	public $components = array('RequestHandler'); 

	public function historico(){

		$this->loadModel('Disciplina');     
		$disciplina = new Disciplina();

		$disciplinas = $disciplina->find('all');

		$this->set(compact($disciplinas, 'disciplinas'));
		$this->set('titulo', 'Historico por aluno');

		$this->layout = 'pdf';

	}
}