<?php 
/* SVN FILE: $Id$ */
/* Browser Test cases generated on: 2009-06-12 13:06:57 : 1244806197*/
App::import('Model', 'Browser');

class BrowserTestCase extends CakeTestCase {
	var $Browser = null;
	var $fixtures = array('app.browser', 'app.combination', 'app.suite', 'app.test');

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
			'name'  => 'Lorem ipsum dolor sit amet',
			'path'  => 'Lorem ipsum dolor sit amet'
			));
		$this->assertEqual($results, $expected);
	}
}
?>