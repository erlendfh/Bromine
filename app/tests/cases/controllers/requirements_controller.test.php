<?php 
/* SVN FILE: $Id$ */
/* RequirementsController Test cases generated on: 2009-01-10 23:01:02 : 1231657922*/
App::import('Controller', 'Requirements');

class TestRequirements extends RequirementsController {
	var $autoRender = false;
}

class RequirementsControllerTest extends CakeTestCase {
	var $Requirements = null;

	function setUp() {
		$this->Requirements = new TestRequirements();
		$this->Requirements->constructClasses();
	}

	function testRequirementsControllerInstance() {
		$this->assertTrue(is_a($this->Requirements, 'RequirementsController'));
	}

	function tearDown() {
		unset($this->Requirements);
	}
}
?>