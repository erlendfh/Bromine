<?php 
/* SVN FILE: $Id$ */
/* User Test cases generated on: 2009-01-10 22:01:56 : 1231656656*/
App::import('Model', 'User');

class TestUser extends User {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class UserTestCase extends CakeTestCase {
	var $User = null;
	var $fixtures = array('app.user', 'app.group');

	function start() {
		parent::start();
		$this->User = new TestUser();
	}

	function testUserInstance() {
		$this->assertTrue(is_a($this->User, 'User'));
	}

	function testUserFind() {
		$this->User->recursive = -1;
		$results = $this->User->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('User' => array(
			'id'  => 1,
			'firstname'  => 'Lorem ipsum dolor sit amet',
			'lastname'  => 'Lorem ipsum dolor sit amet',
			'name'  => 'Lorem ipsum dolor sit amet',
			'password'  => 'Lorem ipsum dolor sit amet',
			'group_id'  => 1,
			'email'  => 'Lorem ipsum dolor sit amet',
			'lastLogin'  => '2009-01-10 22:50:56'
			));
		$this->assertEqual($results, $expected);
	}
}
?>