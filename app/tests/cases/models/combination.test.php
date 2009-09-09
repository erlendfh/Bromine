<?php 
/* SVN FILE: $Id$ */
/* Combination Test cases generated on: 2009-06-12 13:06:36 : 1244806056*/
App::import('Model', 'Combination');

class CombinationTestCase extends CakeTestCase {
	var $Combination = null;
	var $fixtures = array('app.combination', 'app.browser', 'app.operatingsystem');

	function startTest() {
		$this->Combination =& ClassRegistry::init('Combination');
	}

	function testCombinationInstance() {
		$this->assertTrue(is_a($this->Combination, 'Combination'));
	}

	function testCombinationFind() {
		$this->Combination->recursive = -1;
		$results = $this->Combination->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Combination' => array(
			'id'  => 1,
			'browser_id'  => 1,
			'operatingsystem_id'  => 1
			));
		$this->assertEqual($results, $expected);
	}
}
?>