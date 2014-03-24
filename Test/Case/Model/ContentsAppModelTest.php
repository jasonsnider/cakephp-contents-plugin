<?php
App::uses('ContentsAppModel', 'Contents.Model');

/**
 * ContentsAppModel Test Case
 *
 */
class ContentsAppModelTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.contents.contents_app_model'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ContentsAppModel = ClassRegistry::init('Contents.ContentsAppModel');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ContentsAppModel);

		parent::tearDown();
	}

/**
 * testSlug method
 *
 * @return void
 */
	public function testSlug() {
	}

}
