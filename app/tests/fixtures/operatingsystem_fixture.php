<?php 
/* SVN FILE: $Id$ */
/* Operatingsystem Fixture generated on: 2009-06-12 13:06:20 : 1244806220*/

class OperatingsystemFixture extends CakeTestFixture {
	var $name = 'Operatingsystem';
	var $table = 'operatingsystems';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'key' => 'unique'),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'name', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet'
			));
}
?>