<?php 
/* SVN FILE: $Id$ */
/* SitesController Test cases generated on: 2009-01-10 23:01:13 : 1231657933*/
App::import('Controller', 'Sites');

class TestSites extends SitesController {
	var $autoRender = false;
}

class SitesControllerTest extends CakeTestCase {
	var $Sites = null;

	function setUp() {
		$this->Sites = new TestSites();
		$this->Sites->constructClasses();
	}

	function testSitesControllerInstance() {
		$this->assertTrue(is_a($this->Sites, 'SitesController'));
	}

	function tearDown() {
		unset($this->Sites);
	}
}
?>