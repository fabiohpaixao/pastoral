<?php

App::uses('AppController', 'Controller');

class RelatoriosController extends AppController
{

	public function historico(){

		$this->loadModel('Disciplina');     
		$disciplina = new Disciplina();

		$disciplinas = $disciplina->find('all');

		$this->set(compact($disciplinas, 'disciplinas'));

		$this->layout = 'pdf';
	}
}