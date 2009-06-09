<?php

set_include_path(get_include_path() . PATH_SEPARATOR . "drivers/php");
require_once "Testing/Selenium.php";

class BromineTest 
{
  
  function setUp($host, $port, $browser, $sitetotest, $u_id, $t_id)
  {
    $this->u_id = $u_id;
    $this->t_id = $t_id;
    $this->selenium = new Testing_Selenium($browser, $sitetotest, $host ,$port);
    $result = $this->selenium->start();
  }

  function tearDown()
  {
    $this->selenium->stop();
  }
  function testMyTestCase()
  {
    try{
         $this->selenium->open("/");
         $this->selenium->type("q", "hello world");
         $this->selenium->click("btnG");
         $this->selenium->waitForPageToLoad("30000");
         $this->selenium->click("link=Hello worl1d program - Wikipedia, the free encyclopedia");
         $this->selenium->waitForPageToLoad("30000");
         if($this->selenium->isTextPresent("Hello world program") != true){throw new Exception('fejl 40');}
    }
    catch(Exception $e){}
  }
  function customCommand($cmdName, $status, $var1, $var2) 
  {
    $url =  "http://127.0.0.1/selenium-server/driver/index.php?cmd=customCommand&cmdName=$cmdName&status=$status&var1=$var1&var2=$var2&t_id=$this->t_id&u_id=$this->u_id";
    $url=str_replace(" ","%20",$url);
    if($h = fopen($url, "r")){
      fclose($h);
    }
  }
}

function logf($text){
        /*
        $uid = str_replace('.', '', microtime('U'));
        $fp = fopen('C:\logs\log3.txt','a');
        fwrite($fp,$uid . ": " . "$text\n");
        fclose($fp);
    */
    }
$host = $argv[1];
logf("hosTt: " . $host);
logf("port: " . $port = $argv[2]);
logf("browser: " . $browser = $argv[3]);
logf("STT : " . $sitetotest = $argv[4]);
logf("uid : " .$u_id = $argv[5]);
logf("tid : " .$t_id = $argv[6]);
logf("brows2: " .$brows2 = $browser.",".$u_id);
$datafile = $argv[7];

$t = new BromineTest();
$t->setUp($host, $port, $brows2, $sitetotest, $u_id, $t_id);
$t->testMyTestCase();
$t->tearDown();
?>
