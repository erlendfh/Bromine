<?php
set_include_path(get_include_path() . PATH_SEPARATOR . "drivers/php");
require_once "Testing/Selenium.php";
require_once "Testing/BRUnit.php";

class BromineTest extends BRUnit{

  function testMyTestCase() 
  {
    $this->selenium->open("/");
    $this->selenium->type("q", "hello world");
    $this->selenium->click("btnG");
    $this->selenium->waitForPageToLoad("30000");
    $this->selenium->click("link=Hello world program - Wikipedia, the free encyclopedia");
    $this->selenium->waitForPageToLoad("30000");
    $this->assertTrue($this->selenium->isTextPresent("Hello world program"));
    $this->assertFalse($this->selenium->isTextPresent("Hello world program"));
    $this->assertEquals("Hello world program", $this->selenium->getText("firstHeading"));
    $this->customCommand('TEST','passed','VAR1','VAR2');
  }
}

startTest('BromineTest' , $argv);


?>
