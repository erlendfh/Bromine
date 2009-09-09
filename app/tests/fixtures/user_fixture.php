<?php 
/* SVN FILE: $Id$ */
/* User Fixture generated on: 2009-01-10 22:01:56 : 1231656656*/

class UserFixture extends CakeTestFixture {
	var $name = 'User';
	var $table = 'users';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 3, 'key' => 'primary'),
			'firstname' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'lastname' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'key' => 'unique'),
			'password' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'group_id' => array('type'=>'integer', 'null' => false, 'default' => '1'),
			'email' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'lastLogin' => array('type'=>'datetime', 'null' => false, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'name', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'firstname'  => 'Lorem ipsum dolor sit amet',
			'lastname'  => 'Lorem ipsum dolor sit amet',
			'name'  => 'Lorem ipsum dolor sit amet',
			'password'  => 'Lorem ipsum dolor sit amet',
			'group_id'  => 1,
			'email'  => 'Lorem ipsum dolor sit amet',
			'lastLogin'  => '2009-01-10 22:50:56'
			));
}
?>