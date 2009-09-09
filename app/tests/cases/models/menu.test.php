<?php 
/* SVN FILE: $Id$ */
/* Menu Test cases generated on: 2009-01-10 22:01:43 : 1231656283*/
App::import('Model', 'Menu');

class TestMenu extends Menu {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class MenuTestCase extends CakeTestCase {
	var $Menu = null;
	var $fixtures = array('app.menu');

	function start() {
		parent::start();
		$this->Menu = new TestMenu();
	}

	function testMenuInstance() {
		$this->assertTrue(is_a($this->Menu, 'Menu'));
	}

	function testMenuFind() {
		$this->Menu->recursive = -1;
		$results = $this->Menu->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Menu' => array(
			'id'  => 1,
			'p_id'  => 1,
			'title'  => 'Lorem ipsum dolor sit amet',
			'controller'  => 'Lorem ipsum dolor sit amet',
			'action'  => 'Lorem ipsum dolor sit amet',
			'odr'  => 1
			));
		$this->assertEqual($results, $expected);
	}
}
?>