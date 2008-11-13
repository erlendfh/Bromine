<?php
require_once '../../Selenium/Selenium.php';
require_once '../../Libs/ElementLoader.php';
class BromineTest extends ElementLoader
{
	function setUp()
	{
		try
		{
			$this->loadElements('krak','en');
		}
		catch(Exception $e){echo $e->errorMessage();exit;}
		$this->selenium = new Testing_Selenium('*chrome', 'http://krak.dk.test.eniro.net/');
		$result = $this->selenium->start();
	}

	function tearDown()
	{
		$this->selenium->stop();
	}
	function testMyTestCase()
	{
	   //$this->companySearchButton->getId()."\n";

		try{
			$this->selenium->open("/");
			$this->selenium->click($this->company_advanced_search->getId());
			$this->selenium->waitForPageToLoad($this->TIMEOUT);
			$this->selenium->type($this->company_adv_search_adv_search_word->getId(), "");
			$this->selenium->type($this->company_adv_search_company_name->getId(), "Sanistål");
            $this->selenium->type($this->company_adv_search_post_area->getId(), "Odense");
            
            $this->selenium->click($this->company_adv_search_submit->getId());
			$this->selenium->waitForPageToLoad($this->TIMEOUT);
			/*
            for ($page = 1;$page < 10; $page++)
			{
            
				if ($page != 1)
				{
					$this->selenium->click($this->companySearchPageLinks->getXpathWithVars(array('number' => $page)));
					$this->selenium->waitForPageToLoad($this->TIMEOUT);
				}
				*/
				for ($i = 1; $i < 26;$i++)
				{
				    if ($this->selenium->isElementPresent($this->companyResultListName->getXpathWithVars(array('number' => $i))) == true){
    					echo "\n\r $i. ";
                        $name = $this->selenium->getText($this->companyResultListName->getXpathWithVars(array('number' => $i)));
                        
                        if (strpos($name, 'Sanistål') !== false){echo " MATCH!";} else{echo " NOT A MATCH!";}
    					echo " Address: ".$this->selenium->getText($this->companyResultListAddress->getXpathWithVars(array('number' => $i)));
    
    					echo " ZipCode: ".$this->selenium->getText($this->companyResultListZipCode->getXpathWithVars(array('number' => $i)));
    
    					echo " City: ".$this->selenium->getText($this->companyResultListCity->getXpathWithVars(array('number' => $i)));
                    }
				}
				
			//}

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
//$t->tearDown();
?>