<?php
App::uses('Post', 'Contents.Model');

/**
 * Content Test Case
 *
 */
class PostTest extends CakeTestCase {

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
		$this->Post = ClassRegistry::init('Contents.Post');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Post);
		parent::tearDown();
	}
	
/**
 * Passes if the content_type was forced to post
 * @covers Post::beforeSave
 * @return void
 */
	public function testForcesAContentTypeOfPost(){
		$data = array(
			'Post'=>array(
				'controller'=>'Test',
				'controller'=>'test_action',
				'content_type'=>'post'
			)
		);
		
		$this->Post->save($data);
		
		$results = $this->Post->find(
			'first',
			array(
				'conditions'=>array(
					'Post.id' => $this->Post->id
				),
				'contain'=>array()
			)
		);
		
		$this->assertEqual($results['Post']['content_type'], 'post');
	}
	
/**
 * testFetchLatestPost method
 *
 * @covers Post::fetchLatest
 * @return void
 */
	public function testFetchlatest() {
		$results = $this->Post->fetchLatest();
		$this->assertEqual($results['Post']['id'], '52c098f1-6a5c-4dc3-8679-a30c7f000063');
	}
	
/**
 * testFetchLatestPost method
 *
 * @covers Post::fetchLatest
 * @return void
 */
	public function testFetchLatestThrowsAnExceptionOnBadField() {
		
		$expected = false;
		
		try{            
			$this->Post->fetchLatest('bob');        
		}catch(Exception $expected) {
			$expected = true;       
		} 
		
		$this->assertTrue($expected);

	}
}