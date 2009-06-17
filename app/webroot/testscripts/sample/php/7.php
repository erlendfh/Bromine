<?php
set_include_path(get_include_path() . PATH_SEPARATOR . "drivers/php");
require_once "Testing/Selenium.php";
require_once "Testing/BRUnit.php";
require_once "Testing/Dataparser.php";
require_once "Testing/ModuleLoader.php";
require_once "ExcelReader/excel_reader2.php";

class DeletePerson extends BRUnit
{

  function testMyTestCase()
  {
     $dp = new Dataparser($this->orginalPath);
     $strippedURL = $dp->parseURL($this->sitetotest);
     $dp->getDataFromExcel($strippedURL);
     $this->uimap = $dp->uimap;
     $this->datamap = $dp->datamap;
     $this->selenium->open("/");
     $this->loadModule('hej.php');
     for ($second = 0; ; $second++) {
              if ($second >= 15) $this->fail("timeout");
              try {
                        if ($this->selenium->isElementPresent($this->uimap['person result page']['contact form'])) break;
                        else $this->waiting();
              } catch (Exception $e) {}
              sleep(1);
     }

     $this->selenium->click($this->uimap['person result page']['add button']);
     for ($second = 0; ; $second++) {
              if ($second >= 15) $this->fail("timeout");
              try {
                        if ($this->selenium->isTextPresent($this->uimap['person result page']['confirm text'])) break;
                        else $this->waiting();
              } catch (Exception $e) {}
              sleep(1);
     }

     $this->selenium->click($this->uimap['person result page']['close link']);
     $this->selenium->click($this->uimap['person result page']['my contactlist link']);
     $this->selenium->waitForPopUp($this->uimap['person result page']['addressbook'], $this->uimap['selenium']['timeout']);
     $this->selenium->selectWindow($this->uimap['person result page']['popup window']);
     for ($second = 0; ; $second++) {
              if ($second >= 15) $this->fail("timeout");
              try {
                       if ($this->selenium->isElementPresent($this->uimap['person result page']['addressbook-wrap'])) break;
                       else $this->waiting();
              } catch (Exception $e) {}
              sleep(1);
     }

     if($this->selenium->isTextPresent($this->datamap['person name']) != true){throw new Exception('fejl 40');}
     $this->selenium->click($this->uimap['person result page']['close addressbook']);

  }
  
  
  
  
}

startTest('DeletePerson' , $argv);
?>
