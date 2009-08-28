<?php

set_include_path(get_include_path() . PATH_SEPARATOR . "drivers/php");
require_once 'Testing/Selenium.php';
require_once 'Testing/BRUnit.php';

class Example extends BRUnit
{
  function testMyTestCase()
  {
    $this->selenium->open("/");
    $this->selenium->click("//div[@id='gbar']/nobr/a[1]");
    $this->selenium->waitForPageToLoad("30000");
    $this->selenium->click("//a[contains(@href, '/advanced_image_search')]");
    $this->selenium->waitForPageToLoad("30000");
    $this->selenium->type("as_q", "bromine screencast");
    $this->selenium->click("btnG");
    $this->selenium->waitForPageToLoad("30000");
    $this->selenium->click("//img[contains(@src,'brfront.jpg')]");
    $this->selenium->waitForPageToLoad("30000");
    try {
        $this->assertTrue($this->selenium->isElementPresent("link=Bromine 3 screencast"));
    } catch (Exception $e) {}

  }
}
startTest("Example" , $argv);
?>