<?php

set_include_path(get_include_path() . PATH_SEPARATOR . "RC/Drivers/rc-php");
set_include_path(get_include_path() . PATH_SEPARATOR . "STAF");
require_once "../Selenium/Selenium.php";
require_once '../Libs/loadElements.php';
class BromineTest extends loadElements
{
	function setUp()
	{

		$this->selenium = new Testing_Selenium('*chrome', 'http://www.google.dk');
		$result = $this->selenium->start();
	}

	function tearDown()
	{
		$this->selenium->stop();
	}
	function testMyTestCase()
	{	
		$this->loadElements('Elements/google','en');
		try{
			$this->selenium->open("/");
			$this->selenium->type($this->Search_field->getId(), "hello world program");
			$this->selenium->click($this->Search_button->getId());
			echo "'".$this->selenium->getValue('btnG')."' = '" .$this->Search_button->getAttribute('value')."'";
			
			if ($this->selenium->getValue("btnG") == $this->Search_button->getAttribute('value'))
			{
				echo " YES YES";
			}
			else
			{
				echo " NO NO";
			}
			$this->selenium->waitForPageToLoad($this->TIMEOUT);
			$this->selenium->click("link=Hello world program - Wikipedia, the free encyclopedia");
			$this->selenium->waitForPageToLoad($this->TIMEOUT);
			$this->selenium->open("/");
			$this->selenium->type($this->Search_field->getId(), "bromine");
			$this->selenium->click($this->I_feel_lucky_button->getId());
			$this->selenium->waitForPageToLoad($this->TIMEOUT);
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

// php test.php localhost 4444 *firefox http://www.google.dk 123456789 1

$t = new BromineTest();
$t->setUp($host, $port, $brows2, $sitetotest, $u_id, $t_id);
$t->testMyTestCase();
//$t->tearDown();
?>