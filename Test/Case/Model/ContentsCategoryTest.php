<?php
App::uses('ContentsCategory', 'Contents.Model');

/**
 * ContentsCategory Test Case
 *
 */
class ContentsCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.contents.contents_category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ContentsCategory = ClassRegistry::init('Contents.ContentsCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ContentsCategory);

		parent::tearDown();
	}

}
