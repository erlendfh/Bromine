<?php 
/* SVN FILE: $Id$ */
/* TypesController Test cases generated on: 2009-02-13 15:02:46 : 1234535386*/
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