<?php
/* SVN FILE: $Id: cli_reporter.php 5 2006-05-28 10:33:04Z phpnut $ */
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
 * @subpackage   tests.lib
 * @since        CakePHP Test Suite v 1.0.0.0
 * @version      $Revision: 5 $
 * @modifiedby   $LastChangedBy: phpnut $
 * @lastmodified $Date: 2006-05-28 05:33:04 -0500 (Sun, 28 May 2006) $
 * @license      http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
	if (! defined('ST_FAILDETAIL_SEPARATOR')) {
	    define('ST_FAILDETAIL_SEPARATOR', "->");
	}

	if (! defined('ST_FAILS_RETURN_CODE')) {
	    define('ST_FAILS_RETURN_CODE', 1);
	}

	if (version_compare(phpversion(), '4.3.0', '<') ||
	    php_sapi_name() == 'cgi') {
	    define('STDOUT', fopen('php://stdout', 'w'));
	    define('STDERR', fopen('php://stderr', 'w'));
	    register_shutdown_function(
	        create_function('', 'fclose(STDOUT); fclose(STDERR); return true;'));
	}

/**
 * Minimal command line test displayer. Writes fail details to STDERR. Returns 0
 * to the shell if all tests pass, ST_FAILS_RETURN_CODE if any test fails.
 */
class CLIReporter extends SimpleReporter {
	var $faildetail_separator = ST_FAILDETAIL_SEPARATOR;

	function CLIReporter($faildetail_separator = NULL) {
		$this->SimpleReporter();
		if (! is_null($faildetail_separator)) {
			$this->setFailDetailSeparator($faildetail_separator);
		}
	}

	function setFailDetailSeparator($separator) {
		$this->faildetail_separator = $separator;
	}
/**
 * Return a formatted faildetail for printing.
 */
	function &_paintTestFailDetail(&$message) {
		$buffer = '';
		$faildetail = $this->getTestList();
		array_shift($faildetail);
		$buffer .= implode($this->faildetail_separator, $faildetail);
		$buffer .= $this->faildetail_separator . "$message\n";
		return $buffer;
	}
/**
 * Paint fail faildetail to STDERR.
 */
	function paintFail($message) {
		parent::paintFail($message);
		fwrite(STDERR, 'FAIL' . $this->faildetail_separator . $this->_paintTestFailDetail($message));
	}
/**
 * Paint exception faildetail to STDERR.
 */
	function paintException($message) {
		parent::paintException($message);
		fwrite(STDERR, 'EXCEPTION' . $this->faildetail_separator . $this->_paintTestFailDetail($message));
	}
/**
 * Paint a footer with test case name, timestamp, counts of fails and exceptions.
 */
	function paintFooter($test_name) {
		$buffer = $this->getTestCaseProgress() . '/' . $this->getTestCaseCount() . ' test cases complete: ';

		if (0 < ($this->getFailCount() + $this->getExceptionCount())) {
			$buffer .= $this->getPassCount() . " passes";
			if (0 < $this->getFailCount()) {
				$buffer .= ", " . $this->getFailCount() . " fails";
			}
			if (0 < $this->getExceptionCount()) {
				$buffer .= ", " . $this->getExceptionCount() . " exceptions";
			}
			$buffer .= ".\n";
			fwrite(STDOUT, $buffer);
			exit(ST_FAILS_RETURN_CODE);
		} else {
			fwrite(STDOUT, $buffer . $this->getPassCount() . " passes.\n");
		}
	}
}
?>