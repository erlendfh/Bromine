<?php 
/* SVN FILE: $Id$ */
/* MyacosController Test cases generated on: 2009-01-10 23:01:31 : 1231657651*/
App::import('Controller', 'Myacos');

class TestMyacos extends MyacosController {
	var $autoRender = false;
}

class MyacosControllerTest extends CakeTestCase {
	var $Myacos = null;

	function setUp() {
		$this->Myacos = new TestMyacos();
		$this->Myacos->constructClasses();
	}

	function testMyacosControllerInstance() {
		$this->assertTrue(is_a($this->Myacos, 'MyacosController'));
	}

	function tearDown() {
		unset($this->Myacos);
	}
}
?>