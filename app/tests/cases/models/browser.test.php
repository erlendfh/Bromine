<?php 
/* SVN FILE: $Id$ */
/* Browser Test cases generated on: 2009-02-13 14:02:01 : 1234531921*/
App::import('Model', 'Browser');

class BrowserTestCase extends CakeTestCase {
	var $Browser = null;
	var $fixtures = array('app.browser');

	function startTest() {
		$this->Browser =& ClassRegistry::init('Browser');
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