<?php

//echo getcwd();
//C:\xampp\htdocs\app\webroot
/*
set_include_path(get_include_path() . PATH_SEPARATOR . 'drivers\rc-php');
require_once 'Testing/Selenium.php';

$host = $argv[1];
$port = $argv[2];
$browser = $argv[3];
$sitetotest = $argv[4];
$u_id = $argv[5];
$t_id = $argv[6];

echo "\nhost      :" . $host . "\n";
echo "port      :" . $port . "\n";
echo "browser   :" . $browser . "\n";
echo "sitetotest:" . $sitetotest . "\n";
echo "u_id      :" . $u_id . "\n";
echo "t_id      :" . $t_id . "\n";

*/


set_include_path(get_include_path() . PATH_SEPARATOR . 'drivers\php');
require_once 'Testing/Selenium.php';

class GoogleTest 
{
  function setUp($host, $port, $browser, $sitetotest, $u_id, $t_id)
  {
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
    try{
         $this->selenium->open("/");
         $this->customCommand("This Custom Command1" ,"passed", "true", "true");
         $this->selenium->type("q", "bromine openqa");
         $this->selenium->click("btnG");
         $this->selenium->waitForPageToLoad("30000");
         $this->selenium->click("link=exact:OpenQA: Bromine Blog: Bromine arrives at OpenQA");
         $this->selenium->waitForPageToLoad("30000");
         $this->selenium->isTextPresent("Bromine");
         $this->customCommand("This Custom Command2" ,"passed", "true", "true");
         $this->customCommand("This Custom Command3" ,"failed", "true", "true");
         $this->customCommand("This Custom &/ \ Command4" ,"done", "true", "true");
    }catch(Exception $e){}
  }
  
  function customCommand($cmdName, $status, $var1, $var2){
        $cmdName = urlencode($cmdName);
        $status = urlencode($status);
        $var1 = urlencode($var1);
        $var2 = urlencode($var2);
        $url = "http://127.0.0.1/selenium-server/driver/?cmd=customCommand&cmdName=$cmdName&status=$status&var1=$var1&var2=$var2&t_id=$this->t_id&u_id=$this->u_id";
        if($h = fopen($url, "r")){
            fclose($h);
        }
  }
}

    $host = $argv[1];
    $port = $argv[2];
    $browser = $argv[3];
    $sitetotest = $argv[4];
    $u_id = $argv[5];
    $t_id = $argv[6];
    $brows2 = $browser.','.$u_id;
    
    $t = new GoogleTest();
    $t->setUp($host, $port, $brows2, $sitetotest, $u_id, $t_id);
    $t->testMyTestCase();
    $t->tearDown();
?>
