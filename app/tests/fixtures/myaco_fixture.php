<?php 
/* SVN FILE: $Id$ */
/* Myaco Fixture generated on: 2009-01-10 22:01:30 : 1231656330*/

class MyacoFixture extends CakeTestFixture {
	var $name = 'Myaco';
	var $table = 'myacos';
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