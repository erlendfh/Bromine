<?php 
/* SVN FILE: $Id$ */
/* Type Test cases generated on: 2009-01-10 22:01:35 : 1231656635*/
App::import('Model', 'Type');

class TestType extends Type {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class TypeTestCase extends CakeTestCase {
	var $Type = null;
	var $fixtures = array('app.type');

	function start() {
		parent::start();
		$this->Type = new TestType();
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