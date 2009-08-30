<?php

set_include_path(get_include_path() . PATH_SEPARATOR . "drivers/php");
require_once 'Testing/Selenium.php';
require_once 'Testing/BRUnit.php';

class Example extends BRUnit
{
  function testMyTestCase()
  {
    $this->selenium->open("/");
    $this->selenium->type("q", "bromine");
    $this->selenium->click("btnG");
    $this->selenium->waitForPageToLoad("30000");
    $this->selenium->click("link=Bromine: Bromine");
    $this->selenium->waitForPageToLoad("30000");
    $this->assertTrue($this->selenium->isTextPresent("Bromine"));
  }
}
startTest("Example" , $argv);
?>