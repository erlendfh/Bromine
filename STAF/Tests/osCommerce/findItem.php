<?php
require_once 'Selenium/Selenium.php';
require_once 'Libs/ElementLoader.php';
class BromineTest extends ElementLoader
{
	function setUp()
	{
		try
		{
			$this->loadElements('osCommerce','en');
		}
		catch(Exception $e){echo $e->errorMessage();exit;}
		$this->selenium = new Testing_Selenium('*chrome', 'http://localhost/');
		$result = $this->selenium->start();
	}

	function tearDown()
	{
		$this->selenium->stop();
	}
	function testMyTestCase()
	{

		try{
			$searchFor = 'mouse';
			$this->selenium->open("/oscommerce/catalog/");
			//$this->selenium->click("//img[@src='includes/languages/espanol/images/icon.gif']");
			$this->selenium->type($this->searchField->getId(), $searchFor);
			if("The Selenium Shop" != $this->selenium->getTitle()){throw new Exception('fejl 40');}
			$this->selenium->click($this->searchButton->getId());
			$this->selenium->waitForPageToLoad($this->TIMEOUT);
			//if($this->selenium->isElementPresent("//img[@alt='Buy Now']") != true){throw new Exception('fejl 40');}
			for ($i = 0; $i<20;$i++)
			{
				if($this->selenium->isElementPresent($this->productSearchResultListProductName->getXpathWithVars(array('number' => $i + 2))) == true)
				{
					$this->selenium->click($this->productSearchResultListProductName->getXpathWithVars(array('number' => $i + 2)));
					$this->selenium->waitForPageToLoad($this->TIMEOUT);
					$title = $this->selenium->getText($this->productViewHeadline->getId());
					$title = str_replace("\n",'',$title);
					echo "$title - ";
					if (stripos($title,$searchFor) > 0)
					{
						echo "Found\n";
					}
					else
					{
						echo "not found\n";
						//throw new Exception('PIIISSS');
					}

					$this->selenium->goBack();
					$this->selenium->waitForPageToLoad($this->TIMEOUT);
				}
			}

		}
		catch(Testing_Selenium_Exception $e){echo $e->getMessage();}
		catch(Exception $e){echo $e->getMessage();}
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

