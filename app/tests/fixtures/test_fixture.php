<?php 
/* SVN FILE: $Id$ */
/* Test Fixture generated on: 2009-04-03 10:04:57 : 1238746677*/

class TestFixture extends CakeTestFixture {
	var $name = 'Test';
	var $table = 'tests';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
			'status' => array('type'=>'string', 'null' => true, 'default' => NULL),
			'name' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 45),
			'suite_id' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 10),
			'help' => array('type'=>'text', 'null' => false, 'default' => NULL),
			'manstatus' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'author' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'browser_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
			'operatingsystem_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
			'testcase_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'status'  => 'Lorem ipsum dolor sit amet',
			'name'  => 'Lorem ipsum dolor sit amet',
			'suite_id'  => 1,
			'help'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'manstatus'  => 'Lorem ipsum dolor sit amet',
			'author'  => 1,
			'browser_id'  => 1,
			'operatingsystem_id'  => 1,
			'testcase_id'  => 1
			));
}
?>