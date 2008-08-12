<?php

set_include_path(get_include_path() . PATH_SEPARATOR . 'RC/Drivers/rc-php');
require_once 'Testing/Selenium.php';

class GoogleTest 
{
  function setUp($host, $port, $browser, $sitetotest)
  {
    $this->selenium = new Testing_Selenium($browser, $sitetotest, $host ,$port);
    $this->selenium->start();
  }

  function tearDown()
  {
    $this->selenium->stop();
  }
  
  function testMyTestCase()
  {
    try{
         $this->selenium->open("/");
         $this->selenium->type("q", "bromine openqa");
         $this->selenium->click("btnG");
         $this->selenium->waitForPageToLoad("30000");
         $this->selenium->click("link=exact:OpenQA: Bromine Blog: Bromine arrives at OpenQA");
         $this->selenium->waitForPageToLoad("30000");
         $this->selenium->isTextPresent("Bromine");
    }catch(Exception $e){}
  }
}
    $host = $argv[1];
    $port = $argv[2];
    $brows = $argv[3];
    $sitetotest = $argv[4];
    $nodepath = $argv[5];
    $u_id = $argv[6];
    $t_id = $argv[7];
    $brows2 = $brows.','.$nodepath.','.$u_id.','.$t_id;
    
    $t = new GoogleTest();
    $t->setUp($host, $port, $brows2, $sitetotest);
    $t->testMyTestCase();
    $t->tearDown();
?>
