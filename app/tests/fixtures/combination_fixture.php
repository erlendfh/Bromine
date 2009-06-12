<?php 
/* SVN FILE: $Id$ */
/* Combination Fixture generated on: 2009-06-12 13:06:35 : 1244806055*/

class CombinationFixture extends CakeTestFixture {
	var $name = 'Combination';
	var $table = 'combinations';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'browser_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
			'operatingsystem_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'browser_id'  => 1,
			'operatingsystem_id'  => 1
			));
}
?>