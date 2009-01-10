<?php 
/* SVN FILE: $Id$ */
/* Type Fixture generated on: 2009-01-10 22:01:35 : 1231656635*/

class TypeFixture extends CakeTestFixture {
	var $name = 'Type';
	var $table = 'types';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'name' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'command' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'spacer' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'extension' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'command'  => 'Lorem ipsum dolor sit amet',
			'spacer'  => 'Lorem ipsum dolor sit amet',
			'extension'  => 'Lorem ipsum dolor sit amet'
			));
}
?>