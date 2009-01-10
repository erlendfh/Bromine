<?php 
/* SVN FILE: $Id$ */
/* TestcasestepsController Test cases generated on: 2009-01-10 23:01:34 : 1231657954*/
App::import('Controller', 'Testcasesteps');

class TestTestcasesteps extends TestcasestepsController {
	var $autoRender = false;
}

class TestcasestepsControllerTest extends CakeTestCase {
	var $Testcasesteps = null;

	function setUp() {
		$this->Testcasesteps = new TestTestcasesteps();
		$this->Testcasesteps->constructClasses();
	}

	function testTestcasestepsControllerInstance() {
		$this->assertTrue(is_a($this->Testcasesteps, 'TestcasestepsController'));
	}

	function tearDown() {
		unset($this->Testcasesteps);
	}
}
?>