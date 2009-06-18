<?php
set_include_path(get_include_path() . PATH_SEPARATOR . "drivers/php");
require_once "Testing/Selenium.php";
require_once "Testing/BRUnit.php";
require_once "Testing/Dataparser.php";
require_once "ExcelReader/excel_reader2.php";

class AddPerson extends BRUnit
{

  function testMyTestCase()
  {
     
     $dp = new Dataparser();
     $strippedURL = $dp->parseURL($this->sitetotest);
     $dp->getDataFromExcel($strippedURL);
     $this->uimap = $dp->uimap;
     $this->datamap = $dp->datamap;
     //$this->selenium->deleteCookie('PhoneBook','domain=eniro.se');
     $this->selenium->open("/");
     //$this->customCommand(getcwd(),'done','','');
     //$this->selenium->captureEntirePageScreenshot('C:\\ss\\1.png');
     $this->selenium->deleteCookie('PhoneBook',"domain=.$strippedURL");
     $this->assertFalse($this->selenium->isCookiePresent('PhoneBook'));
     $this->selenium->click($this->uimap['menu']['person tab']);
     $this->selenium->waitForPageToLoad($this->uimap['selenium']['timeout']);
     $this->selenium->type($this->uimap['person header']['person what'], $this->datamap['person name2']);
     $this->selenium->click($this->uimap['person header']['submit']);
     $this->selenium->waitForPageToLoad($this->uimap['selenium']['timeout']);
     $this->selenium->click($this->uimap['person result page']['add contact hit 1']);


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

startTest('AddPerson' , $argv);
?>
