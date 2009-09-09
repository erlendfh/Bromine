<?php 
/* SVN FILE: $Id$ */
/* Menu Fixture generated on: 2009-01-10 22:01:43 : 1231656283*/

class MenuFixture extends CakeTestFixture {
	var $name = 'Menu';
	var $table = 'menus';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'p_id' => array('type'=>'integer', 'null' => false, 'default' => '0'),
			'title' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'controller' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'action' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'odr' => array('type'=>'integer', 'null' => false, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'p_id'  => 1,
			'title'  => 'Lorem ipsum dolor sit amet',
			'controller'  => 'Lorem ipsum dolor sit amet',
			'action'  => 'Lorem ipsum dolor sit amet',
			'odr'  => 1
			));
}
?>