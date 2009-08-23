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
    try {
        $this->assertEquals("Bromine: Bromine", $this->selenium->getText("//div[@id='content']/h1"));
    } catch (Exception $e) {}

  }
}
startTest("Example" , $argv);
?>