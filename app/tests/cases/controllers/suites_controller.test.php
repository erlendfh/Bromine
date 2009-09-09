<?php 
/* SVN FILE: $Id$ */
/* SuitesController Test cases generated on: 2009-01-10 23:01:19 : 1231657939*/
App::import('Controller', 'Suites');

class TestSuites extends SuitesController {
	var $autoRender = false;
}

class SuitesControllerTest extends CakeTestCase {
	var $Suites = null;

	function setUp() {
		$this->Suites = new TestSuites();
		$this->Suites->constructClasses();
	}

	function testSuitesControllerInstance() {
		$this->assertTrue(is_a($this->Suites, 'SuitesController'));
	}

	function tearDown() {
		unset($this->Suites);
	}
}
?>