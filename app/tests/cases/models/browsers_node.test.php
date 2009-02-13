<?php 
/* SVN FILE: $Id$ */
/* BrowsersNode Test cases generated on: 2009-02-13 14:02:53 : 1234533053*/
App::import('Model', 'BrowsersNode');

class BrowsersNodeTestCase extends CakeTestCase {
	var $BrowsersNode = null;
	var $fixtures = array('app.browsers_node', 'app.browser', 'app.node');

	function startTest() {
		$this->BrowsersNode =& ClassRegistry::init('BrowsersNode');
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
			'node_id'  => 1
			));
		$this->assertEqual($results, $expected);
	}
}
?>