<?php 
/* SVN FILE: $Id$ */
/* Operatingsystem Test cases generated on: 2009-06-12 13:06:20 : 1244806220*/
App::import('Model', 'Operatingsystem');

class OperatingsystemTestCase extends CakeTestCase {
	var $Operatingsystem = null;
	var $fixtures = array('app.operatingsystem', 'app.combination', 'app.node', 'app.test');

	function startTest() {
		$this->Operatingsystem =& ClassRegistry::init('Operatingsystem');
	}

	function testOperatingsystemInstance() {
		$this->assertTrue(is_a($this->Operatingsystem, 'Operatingsystem'));
	}

	function testOperatingsystemFind() {
		$this->Operatingsystem->recursive = -1;
		$results = $this->Operatingsystem->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Operatingsystem' => array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet'
			));
		$this->assertEqual($results, $expected);
	}
}
?>