<?php
    // $Id: parse_error_test.php 4 2006-04-25 02:08:26Z phpnut $
    
    require_once('../unit_tester.php');
    require_once('../reporter.php');

    $test = &new GroupTest('This should fail');
    $test->addTestFile('test_with_parse_error.php');
    $test->run(new HtmlReporter());
?>