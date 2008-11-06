<?php
require_once 'Selenium/Selenium.php';
require_once 'Libs/ElementLoader.php';
class BromineTest extends ElementLoader
{
	function setUp()
	{
		try
		{
			$this->loadElements('krak','en');
		}
		catch(Exception $e){echo $e->errorMessage();exit;}
		$this->selenium = new Testing_Selenium('*chrome', 'http://www.krak.dk');
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
			$this->selenium->type($this->companySearchField->getId(), "vvs");
			$this->selenium->click($this->companySearchButton->getId());
			$this->selenium->waitForPageToLoad($this->TIMEOUT);
			for ($i = 1; $i < 26;$i++)
			{
				echo "$i. ".$this->selenium->getText($this->companyResultList->getXpathWithVars(array('number' => $i, '1' => 2)));
				echo "\n\r";
			}

		}
		catch(Testing_Selenium_Exception $e){echo $e->errorMessage();}
		catch(Exception $e){echo $e->errorMessage();}
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
// 'php RC/rc-php/sample/trille2.php 127.0.0.1 80 *chrome http://www.google.com 12253266088396 38 '
$t = new BromineTest();
$t->setUp();
$t->testMyTestCase();
$t->tearDown();
?>