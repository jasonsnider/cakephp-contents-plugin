<?php
App::uses('JscForm', 'Contents.Model');

/**
 * JscForm Test Case
 *
 */
class JscFormTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.contents.jsc_form'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->JscForm = ClassRegistry::init('Contents.JscForm');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->JscForm);

		parent::tearDown();
	}

}
