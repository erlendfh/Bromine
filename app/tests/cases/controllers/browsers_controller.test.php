<?php 
/* SVN FILE: $Id$ */
/* BrowsersController Test cases generated on: 2009-01-10 23:01:39 : 1231657599*/
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