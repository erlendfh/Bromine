<?php

require_once 'Selenium.php';

class DataTest
{
    private $find;
    private $arrayOfSearchWord;
    private $search;
    function setUp($s_id, $name, $find, $arrayOfSearchWord)
    {
        $this->find = $find;
        $this->arrayOfSearchWord = $arrayOfSearchWord;
        $host = $_GET["host"];
        $this->selenium = new Testing_Selenium($s_id, $_GET['browser'], $_GET['sitetotest'], get_class($this),$host,"verifyLastCommandTrue");
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
        $this->selenium->open("/person.aspx");
          for($i = 0; $i < count($this->arrayOfSearchWord); $i++ ){
            $this->selenium->type("Who", $this->arrayOfSearchWord[$i]);
            $this->selenium->click("//input[contains(@id,'submit')]");
            $this->selenium->waitForPageToLoad("30000");
            $counter = 2;
            $msg = "go";
            while($msg == "go"){
              try {
                  if($this->selenium->isTextPresent($this->find)!= true){throw new Exception("Fejl 40");}
                  
                  $msg = "error";
              }
              catch (Exception $e) {
                try{
                  $this->selenium->click("link=$counter");
                  $this->selenium->waitForPageToLoad("30000");
                  $counter++;
                }
                catch(Exception $ex){
                  $msg = "error";
                }
             }             
          }
        }      
      }
      catch(Exception $e){     
      }
    }
}
?>
