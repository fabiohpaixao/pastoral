<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function display() {
		$usuario = $this->Auth->user();

		if($usuario['grupo_id'] == Configure::read('Sistema.aluno_id')){

			$this->loadModel('Aluno');
	        $this->Aluno->create();

	        $options = array('conditions' => array('usuario_id' =>  $usuario['id']));
	        $this->Aluno->recursive = 2;
	        $aluno = $this->Aluno->find('first', $options);

	        foreach ($aluno['Turma']['Disciplina'] as $disciplina) {
	        	
	        	$disciplina_temp['Disciplina'] = $disciplina;
	        	
	        	$nota_aluno = 0;
	        	foreach ($aluno['Nota'] as $nota) {
	        		if($nota['Atividade']['disciplina_id'] == $disciplina['id']){
	        			$nota_aluno += $nota['valor'];
	        		}
	        	}

	        	$presenca_aluno = 0;
	        	foreach ($aluno['Frequencia'] as $frequencia) {
	        		if($frequencia['disciplina_id'] == $disciplina['id']){
	        			$presenca_aluno += ($frequencia['presenca']) ? 1 : 0;
	        		}
	        	}

	        	$disciplina_temp['Disciplina']['Nota'] = $nota_aluno;

	        	$disciplina_temp['Disciplina']['Presenca'] = $presenca_aluno;

	        	$dashboard[] = 	$disciplina_temp;
	        }

	        $this->set('dashboard', $dashboard);

			$this->render('alunos');
		}else if($usuario['grupo_id'] == Configure::read('Sistema.professor_id')){
			$this->render('professores');
		}else if($usuario['grupo_id'] == Configure::read('Sistema.diretor_id')){
			$this->render('diretores');
		}


	}

	public function home(){
		$usuario = $this->Auth->user();

		debug($usuario);die();
	}
}
