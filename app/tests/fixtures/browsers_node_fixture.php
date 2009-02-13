<?php 
/* SVN FILE: $Id$ */
/* BrowsersNode Fixture generated on: 2009-02-13 14:02:53 : 1234533053*/

class BrowsersNodeFixture extends CakeTestFixture {
	var $name = 'BrowsersNode';
	var $table = 'browsers_nodes';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'browser_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
			'node_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'browser_id'  => 1,
			'node_id'  => 1
			));
}
?>