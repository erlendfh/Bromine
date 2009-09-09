<?php 
/* SVN FILE: $Id$ */
/* TestcasesController Test cases generated on: 2009-01-10 23:01:25 : 1231657945*/
App::import('Controller', 'Testcases');

class TestTestcases extends TestcasesController {
	var $autoRender = false;
}

class TestcasesControllerTest extends CakeTestCase {
	var $Testcases = null;

	function setUp() {
		$this->Testcases = new TestTestcases();
		$this->Testcases->constructClasses();
	}

	function testTestcasesControllerInstance() {
		$this->assertTrue(is_a($this->Testcases, 'TestcasesController'));
	}

	function tearDown() {
		unset($this->Testcases);
	}
}
?>