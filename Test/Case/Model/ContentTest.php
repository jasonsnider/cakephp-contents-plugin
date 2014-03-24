<?php
App::uses('Content', 'Contents.Model');

/**
 * Content Test Case
 *
 */
class ContentTest extends CakeTestCase {

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
		$this->Content = ClassRegistry::init('Contents.Content');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Content);

		parent::tearDown();
	}
	
/**
 * Passes if the title converts to a matching slug
 * @covers Content::beforeValidate
 * @return void
 */
	public function testTitleConvertsToSlug(){
		$data = array(
			'Content'=>array(
				'title'=>'Testing Title to Slug Functionality'
			)
		);
		
		$this->Content->save($data);
		
		$results = $this->Content->find(
			'first',
			array(
				'conditions'=>array(
					'Content.id' => $this->Content->id
				),
				'contain'=>array()
			)
		);
		
		$this->assertEqual($results['Content']['slug'], 'testing-title-to-slug-functionality');
	}
	
/**
 * testFindByTags method
 * @covers Content::findByTags
 * @return void
 */
	public function testFindByTags() {
		
		$data['tags']='mysql';
		
		$results = $this->Content->findByTags($data);
		
		$hasWhereClause = false;
		
		if(stripos($results, "WHERE `Tag`.`name` = 'mysql'")){
			$hasWhereClause = true;
		}
		
		$this->assertTrue($hasWhereClause);
	}

/**
 * testOrConditions method
 * @covers Content::orConditions
 * @return void
 */
	public function testOrConditions() {
		$data['q']='phpmyadmin';
		
		$results = $this->Content->orConditions($data);
		
		$this->assertArrayHasKey('Content.title LIKE', $results['OR']);
		$this->assertArrayHasKey('Content.body LIKE', $results['OR']);

	}

/**
 * testOrConditions method
 * @covers Content::orConditions
 * @return void
 */
	public function testOrConditionsReturnAnEmptyArrayWhenNoStringIsPassed() {
		
		$data['q']='';
		
		$results = $this->Content->orConditions($data);
		
		$this->assertEmpty($results);

	}
	
/**
 * testContentTypes method
 * @covers Content::contentTypes
 * @return void
 */
	public function testContentTypes() {
		$results = $this->Content->contentTypes();
		
		//Test for proper keys
		$this->assertArrayHasKey('post', $results);
		$this->assertArrayHasKey('page', $results);
		$this->assertArrayHasKey('meta_data', $results);
		
		//Test for the proper number of keys
		$this->assertEqual(count($results), 3);
	}

/**
 * testContentStatuses method
 * @covers Content::contentStatuses
 * @return void
 */
	public function testContentStatuses() {
		$results = $this->Content->contentStatuses();
		
		//Test for proper keys
		$this->assertArrayHasKey('draft', $results);
		$this->assertArrayHasKey('published', $results);
		
		//Test for the proper number of keys
		$this->assertEqual(count($results), 2);
	}

/**
 * testFetchLatestPost method
 *
 * @covers Content::fetchLatestPost
 * @return void
 */
	public function testFetchLatestPost() {
		$results = $this->Content->fetchLatestPost();
		$this->assertEqual($results['Content']['id'], '52c098f1-6a5c-4dc3-8679-a30c7f000063');
	}
	
/**
 * testFetchLatestPost method
 *
 * @covers Content::fetchLatestPost
 * @return void
 */
	public function testFetchLatestPostThrowsAnExceptionOnBadField() {
		
		$expected = false;
		
		try{            
			$this->Content->fetchLatestPost('bob');        
		}catch(Exception $expected) {
			$expected = true;       
		} 
		
		$this->assertTrue($expected);

	}

}