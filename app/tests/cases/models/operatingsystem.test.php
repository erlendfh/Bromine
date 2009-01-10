<?php 
/* SVN FILE: $Id$ */
/* Operatingsystem Test cases generated on: 2009-01-10 22:01:55 : 1231656415*/
App::import('Model', 'Operatingsystem');

class TestOperatingsystem extends Operatingsystem {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class OperatingsystemTestCase extends CakeTestCase {
	var $Operatingsystem = null;
	var $fixtures = array('app.operatingsystem');

	function start() {
		parent::start();
		$this->Operatingsystem = new TestOperatingsystem();
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