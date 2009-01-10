<?php
    // $Id: all_tests.php 4 2006-04-25 02:08:26Z phpnut $
    if (! defined('TEST')) {
        define('TEST', __FILE__);
    }
    require_once(dirname(__FILE__) . '/test_groups.php');
    require_once(dirname(__FILE__) . '/../reporter.php');
    
    $test = &new AllTests();
    if (SimpleReporter::inCli()) {
        $result = $test->run(new SelectiveReporter(new TextReporter(), @$argv[1], @$argv[2]));
        return ($result ? 0 : 1);
    }
    $test->run(new SelectiveReporter(new HtmlReporter(), @$_GET['c'], @$_GET['t']));
?>