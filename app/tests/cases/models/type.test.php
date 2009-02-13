<?php 
/* SVN FILE: $Id$ */
/* Type Test cases generated on: 2009-02-13 15:02:25 : 1234535365*/
App::import('Model', 'Type');

class TypeTestCase extends CakeTestCase {
	var $Type = null;
	var $fixtures = array('app.type');

	function startTest() {
		$this->Type =& ClassRegistry::init('Type');
	}

	function testTypeInstance() {
		$this->assertTrue(is_a($this->Type, 'Type'));
	}

	function testTypeFind() {
		$this->Type->recursive = -1;
		$results = $this->Type->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Type' => array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'command'  => 'Lorem ipsum dolor sit amet',
			'spacer'  => 'Lorem ipsum dolor sit amet',
			'extension'  => 'Lorem ipsum dolor sit amet'
			));
		$this->assertEqual($results, $expected);
	}
}
?>