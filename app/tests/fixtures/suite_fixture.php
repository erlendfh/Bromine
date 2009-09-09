<?php 
/* SVN FILE: $Id$ */
/* Suite Fixture generated on: 2009-01-10 22:01:36 : 1231656516*/

class SuiteFixture extends CakeTestFixture {
	var $name = 'Suite';
	var $table = 'suites';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
			'name' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'site_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
			'status' => array('type'=>'string', 'null' => false, 'default' => '0'),
			'timedate' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
			'timetaken' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 10),
			'browser_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'operating_system_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'selenium_version' => array('type'=>'string', 'null' => true, 'default' => NULL),
			'selenium_revision' => array('type'=>'string', 'null' => true, 'default' => NULL),
			'project_id' => array('type'=>'integer', 'null' => false, 'default' => '0'),
			'analysis' => array('type'=>'boolean', 'null' => false, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'site_id'  => 1,
			'status'  => 'Lorem ipsum dolor sit amet',
			'timedate'  => '2009-01-10 22:48:36',
			'timetaken'  => 1,
			'browser_id'  => 1,
			'operating_system_id'  => 1,
			'selenium_version'  => 'Lorem ipsum dolor sit amet',
			'selenium_revision'  => 'Lorem ipsum dolor sit amet',
			'project_id'  => 1,
			'analysis'  => 1
			));
}
?>