<?php 
/* SVN FILE: $Id$ */
/* BrowsersNode Test cases generated on: 2009-01-10 22:01:31 : 1231656151*/
App::import('Model', 'BrowsersNode');

class TestBrowsersNode extends BrowsersNode {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class BrowsersNodeTestCase extends CakeTestCase {
	var $BrowsersNode = null;
	var $fixtures = array('app.browsers_node', 'app.browser', 'app.node');

	function start() {
		parent::start();
		$this->BrowsersNode = new TestBrowsersNode();
	}

	function testBrowsersNodeInstance() {
		$this->assertTrue(is_a($this->BrowsersNode, 'BrowsersNode'));
	}

	function testBrowsersNodeFind() {
		$this->BrowsersNode->recursive = -1;
		$results = $this->BrowsersNode->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('BrowsersNode' => array(
			'id'  => 1,
			'browser_id'  => 1,
			'node_id'  => 1,
			'browser_path'  => 'Lorem ipsum dolor sit amet'
			));
		$this->assertEqual($results, $expected);
	}
}
?>