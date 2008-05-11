<?php

require_once "Selenium.php";

class Trille 
{
  function setUp($s_id)
  {
    $this->selenium = new Testing_Selenium($s_id, $_GET["browser"], $_GET["sitetotest"], get_class($this), $_GET["host"]);
    $result = $this->selenium->start();
  }

  function tearDown()
  {
    $this->selenium->stop();
    return $this->selenium;
  }
  function testMyTestCase()
  {
  try{
    $this->selenium->open("/");
    $this->selenium->type("Query", "Trille");
    $this->selenium->click("ctl08_submitButton");
    $this->selenium->waitForPageToLoad("30000");
    if($this->selenium->isTextPresent("Trille Aps") != true){throw new Exception('fejl 40');}
    if($this->selenium->isTextPresent("Trille ApS") != true){throw new Exception('fejl 40');}
    if("trille - Krak.dk" != $this->selenium->getTitle()){throw new Exception('fejl 40');}
    if($this->selenium->isElementPresent("link=Trille ApS") != true){throw new Exception('fejl 40');}
    if($this->selenium->isElementPresent("link=Trille ApS") != true){throw new Exception('fejl 40');}
  }
  catch(Exception $e){}
  }
}
?>
