<?php
/**
 * JscFormFixture
 *
 */
class JscFormFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'jsc_form';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'form' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 40000, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'id' => '53aac049-f498-482a-937f-8649ac340345',
			'name' => 'Lorem ipsum dolor sit amet',
			'form' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-06-25 07:27:53',
			'modified' => '2014-06-25 07:27:53'
		),
	);

}
