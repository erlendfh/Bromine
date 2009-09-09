<?php
/* SVN FILE: $Id: tests.php 5 2006-05-28 10:33:04Z phpnut $ */
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
 * Portions modifiied from WACT Test Suite
 * Author(s): Harry Fuecks
 *            Jon Ramsey
 *            Jason E. Sweat
 *            Franco Ponticelli
 *            Lorenzo Alberton
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author       Larry E. Masters aka PhpNut <phpnut@gmail.com>
 * @copyright    Copyright (c) 2006, Larry E. Masters Shorewood, IL. 60431
 * @link         http://www.phpnut.com/projects/
 * @package      tests
 * @since        CakePHP Test Suite v 1.0.0.0
 * @version      $Revision: 5 $
 * @modifiedby   $LastChangedBy: phpnut $
 * @lastmodified $Date: 2006-05-28 05:33:04 -0500 (Sun, 28 May 2006) $
 * @license      http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
	error_reporting(E_ALL);
	set_time_limit(600);
	ini_set('memory_limit','128M');
/**
 * Get root directory
 */
	if (!defined('DS')){
		define('DS', DIRECTORY_SEPARATOR);
	}
	if (!defined('ROOT')){
		define('ROOT', dirname(dirname(dirname(__FILE__))).DS);
	}
	if (!defined('WWW_ROOT')){
		define('WWW_ROOT', dirname(__FILE__).DS);
	}
	if (!defined('APP_DIR')){
    		define ('APP_DIR', basename(dirname(dirname(__FILE__))));
	}
	if (!defined('CORE_PATH')){
		define('CORE_PATH', ROOT.DS);
	}
	require_once 'cake'.DS.'basics.php';
	require_once 'cake'.DS.'config'.DS.'paths.php';
	require_once TESTS . 'test_paths.php';
	require_once TESTS . 'lib'.DS.'test_manager.php';
	vendor('simpletest'.DS.'reporter');
	if (!isset($_SERVER['SERVER_NAME'])){
        $_SERVER['SERVER_NAME'] = '';
    }
    if (empty( $_GET['output'])){
    	TestManager::setOutputFromIni(TESTS . 'config.ini.php');
    	$_GET['output'] = TEST_OUTPUT;
    }
/**
 *
 * Used to determine output to display
 */
	define('CAKE_TEST_OUTPUT_HTML',1);
	define('CAKE_TEST_OUTPUT_XML',2);
	define('CAKE_TEST_OUTPUT_TEXT',3);

	if (isset($_GET['output']) && $_GET['output'] == 'xml'){
		define('CAKE_TEST_OUTPUT', CAKE_TEST_OUTPUT_XML);
	} elseif  (isset($_GET['output']) && $_GET['output'] == 'html') {
		define('CAKE_TEST_OUTPUT', CAKE_TEST_OUTPUT_HTML);
	} else {
		define('CAKE_TEST_OUTPUT', CAKE_TEST_OUTPUT_TEXT);
	}

	function &CakeTestsGetReporter() {
		static $Reporter = NULL;
		if ( !$Reporter ){
			switch (CAKE_TEST_OUTPUT){

				case CAKE_TEST_OUTPUT_XML:
					vendor('simpletest'.DS.'xml');
					$Reporter = new XmlReporter();
				break;
				case CAKE_TEST_OUTPUT_HTML:
					require_once TESTS . 'lib'.DS.'cake_reporter.php';
					$Reporter = new CakeHtmlReporter();
				break;
				default:
					$Reporter = new TextReporter();
					break;
			}
		}
		return $Reporter;
	}

	function CakePHPTestRunMore() {
		switch (CAKE_TEST_OUTPUT) {

			case CAKE_TEST_OUTPUT_XML:
			break;
			case CAKE_TEST_OUTPUT_HTML:
				$link = class_exists('Object') ? "<p><a href='/tests/'>Run more tests</a></p>\n"
											: "<p><a href='" . $_SERVER['PHP_SELF'] . "'>Run more tests</a></p>\n";
				echo $link;
			break;
			case CAKE_TEST_OUTPUT_TEXT:
			default:
			break;
		}
	}

	function CakePHPTestCaseList() {
		switch (CAKE_TEST_OUTPUT) {
			case CAKE_TEST_OUTPUT_XML:
				if (isset($_GET['app'])) {
					echo XmlTestManager::getTestCaseList(APP_TEST_CASES);
				} else {
					echo XmlTestManager::getTestCaseList(CORE_TEST_CASES);
				}
			break;
			case CAKE_TEST_OUTPUT_HTML:
				if (isset($_GET['app'])) {
					echo HtmlTestManager::getTestCaseList(APP_TEST_CASES);
				} else {
					echo HtmlTestManager::getTestCaseList(CORE_TEST_CASES);
				}
			break;
			case CAKE_TEST_OUTPUT_TEXT:
			default:
				if (isset($_GET['app'])) {
					echo TextTestManager::getTestCaseList(APP_TEST_CASES);
				} else {
					echo TextTestManager::getTestCaseList(CORE_TEST_CASES);
				}
			break;
		}
	}

	function CakePHPTestGroupTestList() {
		switch (CAKE_TEST_OUTPUT) {

			case CAKE_TEST_OUTPUT_XML:
				if (isset($_GET['app'])) {
					echo XmlTestManager::getGroupTestList(APP_TEST_GROUPS);
				} else {
					echo XmlTestManager::getGroupTestList(CORE_TEST_GROUPS);
				}
			break;
			case CAKE_TEST_OUTPUT_HTML:
				if (isset($_GET['app'])) {
					echo HtmlTestManager::getGroupTestList(APP_TEST_GROUPS);
				} else {
					echo HtmlTestManager::getGroupTestList(CORE_TEST_GROUPS);
				}
			break;
			case CAKE_TEST_OUTPUT_TEXT:
			default:
				if (isset($_GET['app'])) {
					echo TextTestManager::getGroupTestList(APP_TEST_GROUPS);
				} else {
					echo TextTestManager::getGroupTestList(CORE_TEST_GROUPS);
				}
			break;
		}
	}

	function CakePHPTestHeader() {
		switch (CAKE_TEST_OUTPUT) {

			case CAKE_TEST_OUTPUT_XML:
				header(' content-Type: text/xml; charset="utf-8"');
			break;
			case CAKE_TEST_OUTPUT_HTML:
				$header = <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv=' content-Type' content='text/html; charset=iso-8859-1' />
			<title>CakePHP Test Suite v 1.0.0.0</title>
			<link rel="stylesheet" type="text/css" href="/css/cake.default.css" />
		</head>
			<body>
EOF;
				echo $header;
			break;
			case CAKE_TEST_OUTPUT_TEXT:
			default:
				header(' content-type: text/plain');
			break;
		}
	}

	function CakePHPTestSuiteHeader() {
		switch (CAKE_TEST_OUTPUT) {

			case CAKE_TEST_OUTPUT_XML:
			break;
			case CAKE_TEST_OUTPUT_HTML:
				$groups = class_exists('Object') ? 'groups' : $_SERVER['PHP_SELF'].'?show=groups';
				$cases = class_exists('Object') ? 'cases' : $_SERVER['PHP_SELF'].'?show=cases';
				$suiteHeader = <<<EOD
				<div id="wrapper">
				<div id="header">
					<img src="/img/cake.logo.png" alt="" />
				</div>
				<div id="content">
					<h1>CakePHP Test Suite v 1.0.0.0</h1>
					<p><a href='$groups'>Core Test Groups</a>  ||   <a href='$cases'>Core Test Cases</a></p>
					<p><a href='$groups&amp;app=true'>App Test Groups</a>  ||   <a href='$cases&amp;app=true'>App Test Cases</a></p>
EOD;
				echo $suiteHeader;
			break;
			case CAKE_TEST_OUTPUT_TEXT:
			default:
			break;
		}
	}

	function CakePHPTestSuiteFooter() {
		switch (CAKE_TEST_OUTPUT) {

			case CAKE_TEST_OUTPUT_XML:
			break;
			case CAKE_TEST_OUTPUT_HTML:
				$footer = <<<EOD
				</div>
				<div id="footer">
					<p>
						<a href="https://trac.cakephp.org/wiki/Developement/TestSuite">CakePHP Test Suite </a> ::
						<a href="http://www.phpnut.com/projects/"> &copy; 2006, Larry E. Masters.</a>
					</p> <br />
					<p>
						<!--PLEASE USE ONE OF THE POWERED BY CAKEPHP LOGO-->
						<a href="http://www.cakephp.org/" target="_new">
						<img src="/img/cake.power.png" alt="CakePHP :: Rapid Development Framework" height = "15" width = "80" /> </a>
					</p>
					<p>
						<a href="http://validator.w3.org/check?uri=referer">
						<img src="/img/w3c_xhtml10.png" alt="Valid XHTML 1.0 Transitional" height = "15" width = "80" /> </a>
						<a href="http://jigsaw.w3.org/css-validator/check/referer">
						<img src="/img/w3c_css.png" alt="Valid CSS!" height = "15" width = "80" /> </a>
					</p>
				</div>
				</div>
			</body>
	</html>
EOD;
				echo $footer;
			break;
			case CAKE_TEST_OUTPUT_TEXT:
			default:
				break;
		}
	}

	if (isset($_GET['group'])) {

		if ('all' == $_GET['group']) {
			TestManager::runAllTests(CakeTestsGetReporter());
		} else {
			if (isset($_GET['app'])) {
				TestManager::runGroupTest(ucfirst($_GET['group']), APP_TEST_GROUPS, CakeTestsGetReporter());
			} else {
				TestManager::runGroupTest(ucfirst($_GET['group']), CORE_TEST_GROUPS, CakeTestsGetReporter());
			}
		}

		CakePHPTestRunMore();
		CakePHPTestSuiteFooter();
		exit();
	}

	if (isset($_GET['case'])) {
		TestManager::runTestCase($_GET['case'], CakeTestsGetReporter());
		CakePHPTestRunMore();
		CakePHPTestSuiteFooter();
		exit();
	}

	CakePHPTestHeader();
	CakePHPTestSuiteHeader();

	if (isset($_GET['show']) && $_GET['show'] == 'cases') {
		CakePHPTestCaseList();
	} else {
		CakePHPTestGroupTestList();
	}
	CakePHPTestSuiteFooter();
?>