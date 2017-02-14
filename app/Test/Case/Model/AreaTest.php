<?php
App::uses('Area', 'Kadmin.Model');

/**
 * Area Test Case
 *
 */
class AreaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.kadmin.area',
		'plugin.kadmin.titulo',
		'plugin.kadmin.acesso'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Area = ClassRegistry::init('Kadmin.Area');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Area);

		parent::tearDown();
	}

}
