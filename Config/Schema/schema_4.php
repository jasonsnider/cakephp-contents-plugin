<?php 
class ContentSchema extends CakeSchema {

	public $file = 'schema_4.php';

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $categories = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'slug' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'unique', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'slug' => array('column' => 'slug', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	public $contents = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'slug' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'body' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'description' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'comment' => 'Meta description tag', 'charset' => 'latin1'),
		'keywords' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'comment' => 'Meta keyword tag', 'charset' => 'latin1'),
		'tags' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'canonical' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => 'Your preferred version of a URL for the disambiguation of like content ', 'charset' => 'latin1'),
		'content_type' => array('type' => 'string', 'null' => true, 'default' => 'page', 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'content_status' => array('type' => 'string', 'null' => true, 'default' => 'draft', 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'model' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'model_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'plugin' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'controller' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'action' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'token' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'category_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created_user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null, 'key' => 'index'),
		'modified_user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'person_id' => array('column' => 'model_id', 'unique' => 0),
			'model' => array('column' => 'model', 'unique' => 0),
			'slug' => array('column' => 'slug', 'unique' => 0),
			'tags' => array('column' => 'tags', 'unique' => 0),
			'category_id' => array('column' => 'category_id', 'unique' => 0),
			'created' => array('column' => 'created', 'unique' => 0),
			'modified' => array('column' => 'modified', 'unique' => 0),
			'modified_user_id' => array('column' => 'modified_user_id', 'unique' => 0),
			'created_user_id' => array('column' => 'created_user_id', 'unique' => 0),
			'description' => array('column' => 'description', 'unique' => 0),
			'keywords' => array('column' => 'keywords', 'unique' => 0),
			'plugin' => array('column' => 'plugin', 'unique' => 0),
			'token' => array('column' => 'token', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

}
