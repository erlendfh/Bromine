<?php 
/* SVN FILE: $Id$ */
/* NodesController Test cases generated on: 2009-01-10 23:01:21 : 1231657881*/
App::import('Controller', 'Nodes');

class TestNodes extends NodesController {
	var $autoRender = false;
}

class NodesControllerTest extends CakeTestCase {
	var $Nodes = null;

	function setUp() {
		$this->Nodes = new TestNodes();
		$this->Nodes->constructClasses();
	}

	function testNodesControllerInstance() {
		$this->assertTrue(is_a($this->Nodes, 'NodesController'));
	}

	function tearDown() {
		unset($this->Nodes);
	}
}
?>