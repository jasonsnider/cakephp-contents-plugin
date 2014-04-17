<?php
App::uses('Page', 'Contents.Model');

/**
 * Content Test Case
 *
 */
class PageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.contents.content',
		'plugin.users.user',
		'plugin.users.user_setting',
		'plugin.users.user_profile',
		'plugin.users.email_address',
		'plugin.users.user_group_user',
		'plugin.users.user_group',
		'plugin.users.user_group_privilege',
		'plugin.users.user_privilege',
		'plugin.tags.tag',
		'plugin.tags.tagged'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Page = ClassRegistry::init('Contents.Page');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Page);
		parent::tearDown();
	}
	
/**
 * Passes if the content_type was forced to page
 * @covers Page::beforeSave
 * @return void
 */
	public function testForcesAContentTypeOfPage(){
		$data = array(
			'Page'=>array(
				'controller'=>'Test',
				'controller'=>'test_action',
				'content_type'=>'post'
			)
		);
		
		$this->Page->save($data);
		
		$results = $this->Page->find(
			'first',
			array(
				'conditions'=>array(
					'Page.id' => $this->Page->id
				),
				'contain'=>array()
			)
		);
		
		$this->assertEqual($results['Page']['content_type'], 'page');
	}
}