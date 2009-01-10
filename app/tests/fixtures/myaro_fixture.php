<?php 
/* SVN FILE: $Id$ */
/* Myaro Fixture generated on: 2009-01-10 22:01:49 : 1231656349*/

class MyaroFixture extends CakeTestFixture {
	var $name = 'Myaro';
	var $table = 'myaros';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
			'parent_id' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 10),
			'alias' => array('type'=>'string', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'parent_id'  => 1,
			'alias'  => 'Lorem ipsum dolor sit amet'
			));
}
?>