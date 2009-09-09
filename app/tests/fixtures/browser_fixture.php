<?php 
/* SVN FILE: $Id$ */
/* Browser Fixture generated on: 2009-06-12 13:06:57 : 1244806197*/

class BrowserFixture extends CakeTestFixture {
	var $name = 'Browser';
	var $table = 'browsers';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'key' => 'unique'),
			'path' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 100),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'name', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'path'  => 'Lorem ipsum dolor sit amet'
			));
}
?>