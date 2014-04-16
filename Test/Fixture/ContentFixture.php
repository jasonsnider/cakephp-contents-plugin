<?php
/**
 * ContentFixture
 *
 */
class ContentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'slug' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'body' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'description' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'latin1_swedish_ci', 'comment' => 'Meta description tag', 'charset' => 'latin1'),
		'keywords' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'latin1_swedish_ci', 'comment' => 'Meta keyword tag', 'charset' => 'latin1'),
		'canonical' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => 'Your preferred version of a URL for the disambiguation of like content ', 'charset' => 'latin1'),
		'content_type' => array('type' => 'string', 'null' => true, 'default' => 'page', 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'content_status' => array('type' => 'string', 'null' => true, 'default' => 'draft', 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'model' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'model_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'controller' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'action' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created_user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified_user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'person_id' => array('column' => 'model_id', 'unique' => 0),
			'model' => array('column' => 'model', 'unique' => 0),
			'slug' => array('column' => 'slug', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '52c098f1-6a5c-4dc3-8679-a30c7f000062',
			'title' => 'First Published',
			'slug' => 'first-published',
			'body' => 'I am the first',
			'description' => '',
			'keywords' => '',
			'canonical' => null,
			'content_type' => 'post',
			'content_status' => 'published',
			'model' => null,
			'model_id' => null,
			'controller' => '',
			'action' => '',
			'created_user_id' => '52339615-7200-45d8-b115-acf77f00000a',
			'created' => '2013-12-27 15:49:37',
			'modified_user_id' => '',
			'modified' => '2013-12-27 15:49:37'
		),
		array(
			'id' => '52c098f1-6a5c-4dc3-8679-a30c7f000063',
			'title' => 'Latest Published',
			'slug' => 'latest Published',
			'body' => 'I am the latest',
			'description' => '',
			'keywords' => '',
			'canonical' => null,
			'content_type' => 'post',
			'content_status' => 'published',
			'model' => null,
			'model_id' => null,
			'controller' => '',
			'action' => '',
			'created_user_id' => '52339615-7200-45d8-b115-acf77f00000a',
			'created' => '2013-12-28 15:49:37',
			'modified_user_id' => '',
			'modified' => '2013-12-28 15:49:37'
		),
		array(
			'id' => '52c098f1-6a5c-4dc3-8679-a30c7f000064',
			'title' => 'Latest Draft',
			'slug' => 'latest-draft',
			'body' => '',
			'description' => 'I am the latest draft',
			'keywords' => '',
			'canonical' => null,
			'content_type' => 'post',
			'content_status' => 'draft',
			'model' => null,
			'model_id' => null,
			'controller' => '',
			'action' => '',
			'created_user_id' => '52339615-7200-45d8-b115-acf77f00000a',
			'created' => '2013-12-29 15:49:37',
			'modified_user_id' => '',
			'modified' => '2013-12-29 15:49:37'
		),
		array(
			'id' => '52c098f1-6a5c-4dc3-8679-a30c7f0000164',
			'title' => 'Home Page',
			'slug' => '',
			'body' => '',
			'description' => 'I am the meta data for the home page',
			'keywords' => 'meta data, home page',
			'canonical' => null,
			'content_type' => 'meta_data',
			'content_status' => 'published',
			'model' => null,
			'model_id' => null,
			'controller' => 'Pages',
			'action' => 'home',
			'created_user_id' => '52339615-7200-45d8-b115-acf77f00000a',
			'created' => '2013-12-29 15:49:37',
			'modified_user_id' => '',
			'modified' => '2013-12-29 15:49:37'
		),
	);

}
