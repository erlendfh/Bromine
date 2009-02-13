<?php 
/* SVN FILE: $Id$ */
/* Node Test cases generated on: 2009-02-13 15:02:13 : 1234533733*/
App::import('Model', 'Node');

class NodeTestCase extends CakeTestCase {
	var $Node = null;
	var $fixtures = array('app.node', 'app.operatingsystem');

	function startTest() {
		$this->Node =& ClassRegistry::init('Node');
	}

	function testNodeInstance() {
		$this->assertTrue(is_a($this->Node, 'Node'));
	}

	function testNodeFind() {
		$this->Node->recursive = -1;
		$results = $this->Node->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Node' => array(
			'id'  => 1,
			'nodepath'  => 'Lorem ipsum dolor sit amet',
			'operatingsystem_id'  => 1,
			'description'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'network_drive'  => 'Lorem ipsum dolor sit amet'
			));
		$this->assertEqual($results, $expected);
	}
}
?>