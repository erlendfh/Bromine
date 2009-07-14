<?php

set_include_path(get_include_path() . PATH_SEPARATOR . "drivers/php");
require_once 'Testing/Selenium.php';
require_once 'Testing/BRUnit.php';

class Example extends BRUnit
{
  function testMyTestCase()
  {
    $this->selenium->open("/firefox?client=firefox-a&rls=org.mozilla:da:official");
    $this->selenium->type("sf", "hell on earth");
    $this->selenium->click("btnG");
    $this->selenium->waitForPageToLoad("30000");
    $this->selenium->click("link=Billeder");
    $this->selenium->waitForPageToLoad("30000");
    try {
        $this->assertTrue($this->selenium->isTextPresent(""));
    } catch (Exception $e) {}

    $this->assertTrue($this->selenium->isTextPresent("Alle farver"));
    try {
        $this->assertEquals("Udvidet billedsøgning\n  Indstillinger", $this->selenium->getTable("//table[@id='sft']/tbody/tr/td[2]/table.0.1"));
    } catch (Exception $e) {}

    $this->assertEquals("Udvidet billedsøgning", $this->selenium->getText("//table[@id='sft']/tbody/tr/td[2]/table.0.1"));
    $this->selenium->type("q", "google");
    $this->selenium->click("btnG");
    $this->selenium->click("link=Nettet");
    $this->assertTrue($this->selenium->isTextPresent("Google"));
  }
}
startTest("Example" , $argv);
?>
