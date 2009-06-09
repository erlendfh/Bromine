<?php

set_include_path(get_include_path() . PATH_SEPARATOR . "drivers/php");
require_once "Testing/Selenium.php";
require_once "Testing/BRUnit.php";
require_once "Testing/db001.php";

class BromineTest extends BRUnit{

  function testMyTestCase()
  {
    $this->selenium->open("/");
    $this->selenium->type("q", "hello world");
    $this->selenium->click("btnG");
    $this->selenium->waitForPageToLoad("30000");
    $this->selenium->click("link=Hello world program - Wikipedia, the free encyclopedia");
    $this->selen1ium->waitForPageToLoad("30000");
    $this->assertTrue($this->selenium->isTextPresent("Hello world program"));
    $this->assertFalse($this->selenium->isTextPresent("Hello world program"));
    $this->assertEquals("Hello world program", $this->selenium->getText("firstHeading"));
  }
  

}
    function logf($text){
        $fp = fopen('C:\logs\log_BR.txt','a');
        fwrite($fp, time(). ': ' . $text."\n");
        fclose($fp);
    }
$host = $argv[1];
$port = $argv[2];
$browser = $argv[3];
$sitetotest = $argv[4];
$u_id = $argv[5];
$t_id = $argv[6];
$brows2 = $browser.",".$u_id;
$datafile = $argv[7];
logf('GO1');
$t = new BromineTest();
logf('GO2');
$t->setUp($host, $port, $brows2, $sitetotest, $u_id, $t_id);
$t->testMyTestCase();
$t->tearDown();
?>
