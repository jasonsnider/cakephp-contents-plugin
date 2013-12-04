<?php 
class ContentSchema extends CakeSchema {

	public $file = 'contents_1.php';

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $contents = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'slug' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'body' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'description' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'latin1_swedish_ci', 'comment' => 'Meta description tag', 'charset' => 'latin1'),
		'keywords' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'latin1_swedish_ci', 'comment' => 'Meta keyword tag', 'charset' => 'latin1'),
		'canonical' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => 'Your preferred version of a URL for the disambiguation of like content ', 'charset' => 'latin1'),
		'content_type' => array('type' => 'string', 'null' => true, 'default' => 'page', 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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

}
