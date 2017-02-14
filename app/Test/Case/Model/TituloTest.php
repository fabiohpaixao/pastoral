<?php
App::uses('Titulo', 'Kadmin.Model');

/**
 * Titulo Test Case
 *
 */
class TituloTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.kadmin.titulo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Titulo = ClassRegistry::init('Kadmin.Titulo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Titulo);

		parent::tearDown();
	}

}
