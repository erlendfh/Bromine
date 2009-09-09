<?php
/* SVN FILE: $Id: dispatcher.test.php 5 2006-05-28 10:33:04Z phpnut $ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP Test Suite <https://trac.cakephp.org/wiki/Developement/TestSuite>
 * Copyright (c) 2006, Larry E. Masters Shorewood, IL. 60431
 * Author(s): Larry E. Masters aka PhpNut <phpnut@gmail.com>
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author       Larry E. Masters aka PhpNut <phpnut@gmail.com>
 * @copyright    Copyright (c) 2006, Larry E. Masters Shorewood, IL. 60431
 * @link         http://www.phpnut.com/projects/
 * @package      test_suite
 * @subpackage   test_suite.cases.app
 * @since        CakePHP Test Suite v 1.0.0.0
 * @version      $Revision: 5 $
 * @modifiedby   $LastChangedBy: phpnut $
 * @lastmodified $Date: 2006-05-28 05:33:04 -0500 (Sun, 28 May 2006) $
 * @license      http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
	require_once LIBS.'neat_array.php';
	require_once CAKE.'dispatcher.php';
/**
 * Short description for class.
 *
 * @package    test_suite
 * @subpackage test_suite.cases.libs
 * @since      CakePHP Test Suite v 1.0.0.0
 */
class DispatcherTest extends UnitTestCase {

	function testParseParamsWithoutZerosAndEmptyPost() {
		$dispatcher =& new Dispatcher();
		$test = $dispatcher->parseParams("/testcontroller/testaction/params1/params2/params3");
		$this->assertIdentical($test['controller'], 'testcontroller', "<br />Parsed URL shows controller is {$test['controller']} expected testcontroller" );
		$this->assertIdentical($test['action'], 'testaction', "<br />Parsed URL shows action is {$test['action']} expected testaction" );
		$this->assertIdentical($test['pass'][0], 'params1', "<br />Parsed URL shows action is {$test['pass'][0]} expected params1" );
		$this->assertIdentical($test['pass'][1], 'params2', "<br />Parsed URL shows action is {$test['pass'][1]} expected params2" );
		$this->assertIdentical($test['pass'][2], 'params3', "<br />Parsed URL shows action is {$test['pass'][2]} expected params3" );
		$this->assertFalse(!empty($test['form']), "<br />Parsed URL returning post data expected not post data");
	}

	function testParseParamsReturnsPostedData() {
		$_POST['testdata'] = "My Posted Content";
		$dispatcher =& new Dispatcher();
		$test = $dispatcher->parseParams("/");
		$this->assertTrue($test['form'], "Parsed URL not returning post data");
		$this->assertIdentical($test['form']['testdata'],
											"My Posted Content",
											"'Post content is {$test['form']['testdata']} expected My Posted Content");
	}

	function testParseParamsWithSingleZero() {
		$dispatcher =& new Dispatcher();
		$test = $dispatcher->parseParams("/testcontroller/testaction/1/0/23");
		$this->assertIdentical($test['controller'], 'testcontroller', "<br />Parsed URL shows controller is {$test['controller']} expected testcontroller" );
		$this->assertIdentical($test['action'], 'testaction', "<br />Parsed URL shows action is {$test['action']} expected testaction" );
		$this->assertIdentical($test['pass'][0], '1', "value is {$test['pass'][0]} expected 1" );
		$this->assertPattern('/\\A(?:0)\\z/', $test['pass'][1], "value is {$test['pass'][1]} expected 0" );
		$this->assertIdentical($test['pass'][2], '23', "value is {$test['pass'][2]} expected 23" );
	}

	function testParseParamsWithManySingleZeros() {
		$dispatcher =& new Dispatcher();
		$test = $dispatcher->parseParams("/testcontroller/testaction/0/0/0/0/0/0");
		$this->assertPattern('/\\A(?:0)\\z/', $test['pass'][0], "value is {$test['pass'][0]} expected 0" );
		$this->assertPattern('/\\A(?:0)\\z/', $test['pass'][1], "value is {$test['pass'][1]} expected 0" );
		$this->assertPattern('/\\A(?:0)\\z/', $test['pass'][2], "value is {$test['pass'][2]} expected 0" );
		$this->assertPattern('/\\A(?:0)\\z/', $test['pass'][3], "value is {$test['pass'][3]} expected 0" );
		$this->assertPattern('/\\A(?:0)\\z/', $test['pass'][4], "value is {$test['pass'][4]} expected 0" );
		$this->assertPattern('/\\A(?:0)\\z/', $test['pass'][5], "value is {$test['pass'][5]} expected 0" );
	}

	function testParseParamsWithManyZerosInEachSectionOfUrl() {
		$dispatcher =& new Dispatcher();
		$test = $dispatcher->parseParams("/testcontroller/testaction/000/0000/00000/000000/000000/0000000");
		$this->assertPattern('/\\A(?:000)\\z/', $test['pass'][0], "value is {$test['pass'][0]} expected 000" );
		$this->assertPattern('/\\A(?:0000)\\z/', $test['pass'][1], "value is {$test['pass'][1]} expected 0000" );
		$this->assertPattern('/\\A(?:00000)\\z/', $test['pass'][2], "value is {$test['pass'][2]} expected 00000" );
		$this->assertPattern('/\\A(?:000000)\\z/', $test['pass'][3], "value is {$test['pass'][3]} expected 000000" );
		$this->assertPattern('/\\A(?:000000)\\z/', $test['pass'][4], "value is {$test['pass'][4]} expected 000000" );
		$this->assertPattern('/\\A(?:0000000)\\z/', $test['pass'][5], "value is {$test['pass'][5]} expected 0000000" );
	}

	function testParseParamsWithMixedOneToManyZerosInEachSectionOfUrl() {
		$dispatcher =& new Dispatcher();
		$test = $dispatcher->parseParams("/testcontroller/testaction/01/0403/04010/000002/000030/0000400");
		$this->assertPattern('/\\A(?:01)\\z/', $test['pass'][0], "value is {$test['pass'][0]} expected 01" );
		$this->assertPattern('/\\A(?:0403)\\z/', $test['pass'][1], "value is {$test['pass'][1]} expected 0403" );
		$this->assertPattern('/\\A(?:04010)\\z/', $test['pass'][2], "value is {$test['pass'][2]} expected 04010" );
		$this->assertPattern('/\\A(?:000002)\\z/', $test['pass'][3], "value is {$test['pass'][3]} expected 000002" );
		$this->assertPattern('/\\A(?:000030)\\z/', $test['pass'][4], "value is {$test['pass'][4]} expected 000030" );
		$this->assertPattern('/\\A(?:0000400)\\z/', $test['pass'][5], "value is {$test['pass'][5]} expected 0000400" );
	}
}
?>