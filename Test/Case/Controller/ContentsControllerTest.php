<?php
App::uses('ContentsController', 'Contents.Controller');

/**
 * ContentsController Test Case
 *
 */
class ContentsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.contents.content',
		'plugin.contents.user',
		'plugin.contents.user_setting',
		'plugin.contents.user_profile',
		'plugin.contents.email_address',
		'plugin.contents.user_group_user',
		'plugin.contents.user_group',
		'plugin.contents.user_group_privilege',
		'plugin.contents.user_privilege',
		'plugin.contents.category',
		'plugin.contents.categories_content',
		'plugin.contents.tag',
		'plugin.contents.tagged'
	);

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
	}

}
