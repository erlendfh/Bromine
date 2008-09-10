<?php

set_include_path(get_include_path() . PATH_SEPARATOR . 'RC/Drivers/rc-php');
require_once 'Testing/Selenium.php';

class GoogleTest 
{
  function setUp($host, $port, $browser, $sitetotest, $u_id, $t_id)
  {
  	$this->host = $host;
    $this->u_id = $u_id;
    $this->t_id = $t_id;
    $this->selenium = new Testing_Selenium($browser, $sitetotest, $host ,$port);
    $this->selenium->start();
  }

  function tearDown()
  {
    $this->selenium->stop();
  }
  
  function testMyTestCase()
  {	
		$this->selenium->open("/");
		$this->selenium->type("q", "bromine openqa");
		$this->customCommand("My very own custom command" ,"passed", "true", "true");
		$this->selenium->click("btnG");
		$this->selenium->waitForPageToLoad("30000");
		$this->selenium->click("link=exact:OpenQA: Bromine Blog: Bromine arrives at OpenQA");
		$this->selenium->waitForPageToLoad("30000");
		$this->selenium->isTextPresent("Bromine");
		$this->customCommand("Assert this" ,"failed", "Value 1", "value 2");
  }
  
  function customCommand($cmdName, $status, $var1, $var2){
  		require_once "HTTP/Request.php";
        $url = "http://".$this->host."/selenium-server/driver/index.php";
		$r = new Http_Request($url);
		$cmdName = urlencode($cmdName);
		$status = urlencode($status);
		$var1 = urlencode($var1);
		$var2 = urlencode($var2);
		$q ="cmd=customCommand&cmdName=$cmdName&status=$status&var1=$var1&var2=$var2&t_id=$this->t_id&u_id=$this->u_id";
		$r->addRawQueryString($q);
		$r->sendRequest();
		echo $r->getResponseBody()."<br />";
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
    $t->setUp($host, $port, $brows2, $sitetotest, $u_id, $t_id);
    $t->testMyTestCase();
    $t->tearDown();
?>
