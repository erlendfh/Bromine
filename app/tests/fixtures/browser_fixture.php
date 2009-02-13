<?php 
/* SVN FILE: $Id$ */
/* Browser Fixture generated on: 2009-02-13 14:02:59 : 1234531919*/

class BrowserFixture extends CakeTestFixture {
	var $name = 'Browser';
	var $table = 'browsers';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'browsername' => array('type'=>'string', 'null' => false, 'default' => NULL, 'key' => 'unique'),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'browsername', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'browsername'  => 'Lorem ipsum dolor sit amet'
			));
}
?>