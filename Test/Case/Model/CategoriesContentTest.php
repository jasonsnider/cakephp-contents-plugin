<?php
App::uses('CategoriesContent', 'Contents.Model');

/**
 * CategoriesContent Test Case
 *
 */
class CategoriesContentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.contents.categories_content',
		'plugin.contents.category',
		'plugin.contents.content'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CategoriesContent = ClassRegistry::init('Contents.CategoriesContent');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CategoriesContent);

		parent::tearDown();
	}

}
