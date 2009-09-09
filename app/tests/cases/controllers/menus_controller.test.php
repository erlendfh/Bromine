<?php 
/* SVN FILE: $Id$ */
/* MenusController Test cases generated on: 2009-01-10 23:01:20 : 1231657640*/
App::import('Controller', 'Menus');

class TestMenus extends MenusController {
	var $autoRender = false;
}

class MenusControllerTest extends CakeTestCase {
	var $Menus = null;

	function setUp() {
		$this->Menus = new TestMenus();
		$this->Menus->constructClasses();
	}

	function testMenusControllerInstance() {
		$this->assertTrue(is_a($this->Menus, 'MenusController'));
	}

	function tearDown() {
		unset($this->Menus);
	}
}
?>