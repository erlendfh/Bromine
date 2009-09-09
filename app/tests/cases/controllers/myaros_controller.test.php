<?php 
/* SVN FILE: $Id$ */
/* MyarosController Test cases generated on: 2009-01-10 23:01:40 : 1231657660*/
App::import('Controller', 'Myaros');

class TestMyaros extends MyarosController {
	var $autoRender = false;
}

class MyarosControllerTest extends CakeTestCase {
	var $Myaros = null;

	function setUp() {
		$this->Myaros = new TestMyaros();
		$this->Myaros->constructClasses();
	}

	function testMyarosControllerInstance() {
		$this->assertTrue(is_a($this->Myaros, 'MyarosController'));
	}

	function tearDown() {
		unset($this->Myaros);
	}
}
?>