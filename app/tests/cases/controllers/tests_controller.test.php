<?php 
/* SVN FILE: $Id$ */
/* TestsController Test cases generated on: 2009-01-10 23:01:56 : 1231657976*/
App::import('Controller', 'Tests');

class TestTests extends TestsController {
	var $autoRender = false;
}

class TestsControllerTest extends CakeTestCase {
	var $Tests = null;

	function setUp() {
		$this->Tests = new TestTests();
		$this->Tests->constructClasses();
	}

	function testTestsControllerInstance() {
		$this->assertTrue(is_a($this->Tests, 'TestsController'));
	}

	function tearDown() {
		unset($this->Tests);
	}
}
?>