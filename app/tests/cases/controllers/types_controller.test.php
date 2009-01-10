<?php 
/* SVN FILE: $Id$ */
/* TypesController Test cases generated on: 2009-01-10 23:01:08 : 1231657988*/
App::import('Controller', 'Types');

class TestTypes extends TypesController {
	var $autoRender = false;
}

class TypesControllerTest extends CakeTestCase {
	var $Types = null;

	function setUp() {
		$this->Types = new TestTypes();
		$this->Types->constructClasses();
	}

	function testTypesControllerInstance() {
		$this->assertTrue(is_a($this->Types, 'TypesController'));
	}

	function tearDown() {
		unset($this->Types);
	}
}
?>