<?php 
/* SVN FILE: $Id$ */
/* Browser Test cases generated on: 2009-01-10 22:01:23 : 1231655723*/
App::import('Model', 'Browser');

class TestBrowser extends Browser {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class BrowserTestCase extends CakeTestCase {
	var $Browser = null;
	var $fixtures = array('app.browser', 'app.suite');

	function start() {
		parent::start();
		$this->Browser = new TestBrowser();
	}

	function testBrowserInstance() {
		$this->assertTrue(is_a($this->Browser, 'Browser'));
	}

	function testBrowserFind() {
		$this->Browser->recursive = -1;
		$results = $this->Browser->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Browser' => array(
			'id'  => 1,
			'browsername'  => 'Lorem ipsum dolor sit amet'
			));
		$this->assertEqual($results, $expected);
	}
}
?>