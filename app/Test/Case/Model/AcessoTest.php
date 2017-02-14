<?php
App::uses('Acesso', 'Kadmin.Model');

/**
 * Acesso Test Case
 *
 */
class AcessoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.kadmin.acesso',
		'plugin.kadmin.grupo',
		'plugin.kadmin.area'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Acesso = ClassRegistry::init('Kadmin.Acesso');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Acesso);

		parent::tearDown();
	}

}
