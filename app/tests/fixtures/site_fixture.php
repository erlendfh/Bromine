<?php 
/* SVN FILE: $Id$ */
/* Site Fixture generated on: 2009-01-10 22:01:17 : 1231656497*/

class SiteFixture extends CakeTestFixture {
	var $name = 'Site';
	var $table = 'sites';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'name' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'project_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'project_id'  => 1
			));
}
?>