<?php 
/* SVN FILE: $Id$ */
/* CommandsController Test cases generated on: 2009-01-10 23:01:59 : 1231657619*/
App::import('Controller', 'Commands');

class TestCommands extends CommandsController {
	var $autoRender = false;
}

class CommandsControllerTest extends CakeTestCase {
	var $Commands = null;

	function setUp() {
		$this->Commands = new TestCommands();
		$this->Commands->constructClasses();
	}

	function testCommandsControllerInstance() {
		$this->assertTrue(is_a($this->Commands, 'CommandsController'));
	}

	function tearDown() {
		unset($this->Commands);
	}
}
?>