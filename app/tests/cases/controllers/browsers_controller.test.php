<?php 
/* SVN FILE: $Id$ */
/* BrowsersController Test cases generated on: 2009-02-13 15:02:24 : 1234534884*/
App::import('Controller', 'Browsers');

class TestBrowsers extends BrowsersController {
	var $autoRender = false;
}

class BrowsersControllerTest extends CakeTestCase {
	var $Browsers = null;

	function setUp() {
		$this->Browsers = new TestBrowsers();
		$this->Browsers->constructClasses();
	}

	function testBrowsersControllerInstance() {
		$this->assertTrue(is_a($this->Browsers, 'BrowsersController'));
	}

	function tearDown() {
		unset($this->Browsers);
	}
}
?>