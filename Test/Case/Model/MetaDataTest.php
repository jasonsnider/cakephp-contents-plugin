<?php
App::uses('MetaData', 'Contents.Model');

/**
 * Content Test Case
 *
 */
class MetaDataTest extends CakeTestCase {

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
		$this->MetaData = ClassRegistry::init('Contents.MetaData');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MetaData);
		parent::tearDown();
	}
	
/**
 * Passes if the content_type was forced to meta_data
 * @covers MetaData::beforeSave
 * @return void
 */
	public function testForcesAContentTypeOfMetaData(){
		$data = array(
			'MetaData'=>array(
				'controller'=>'Test',
				'controller'=>'test_action',
				'content_type'=>'post'
			)
		);
		
		$this->MetaData->save($data);
		
		$results = $this->MetaData->find(
			'first',
			array(
				'conditions'=>array(
					'MetaData.id' => $this->MetaData->id
				),
				'contain'=>array()
			)
		);
		
		$this->assertEqual($results['MetaData']['content_type'], 'meta_data');
	}
	
/**
 * Passes if the expected data is returned
 * @covers MetaData::fetchMetaDataForControllerAction
 * @return void
 */
	public function testFetchMetaDataForControllerAction(){
		
		$results = $this->MetaData->fetchMetaDataForControllerAction('Pages', 'home');
		
		$this->assertEqual($results['MetaData']['title'], 'Home Page');
	}
}