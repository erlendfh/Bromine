<?php

set_include_path(get_include_path() . PATH_SEPARATOR . "drivers/php");
require_once 'Testing/Selenium.php';
require_once 'Testing/BRUnit.php';

class Example extends BRUnit
{
  function testMyTestCase()
  {
    $this->selenium->open("/");
    $this->selenium->type("UserName", "admin");
    $this->selenium->type("UserPassword", "admin");
    $this->selenium->click("//input[@value='Login']");
    $this->selenium->waitForPageToLoad("30000");
    $this->assertEquals("Projects", $this->selenium->getTitle());
  }
}
startTest("Example" , $argv);
?>