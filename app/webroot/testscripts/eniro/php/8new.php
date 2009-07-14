<?php
set_include_path(get_include_path() . PATH_SEPARATOR . "drivers/php");
require_once "Testing/Selenium.php";
require_once "Testing/BRUnit.php";
require_once "Testing/Dataparser.php";
require_once "ExcelReader/excel_reader2.php";

class DeletePerson extends BRUnit
{

  function testMyTestCase()
  {  
     $dp = new Dataparser($this->orginalPath);
     $this->strippedURL = $dp->parseURL($this->sitetotest);
     $dp->getDataFromExcel($this->strippedURL);
     $this->uimap = $dp->uimap;
     $this->datamap = $dp->datamap;
     $this->selenium->open("/");
     
     print_r($this->datamap);
     
     
     $this->loadModule('removePhoneBookCookie');
     $this->loadModule('peopleSearch');
     $this->loadModule("addAllContacts");
     $this->loadModule('openPhoneBook');
     $this->loadModule('verifyFirstContact');
     $this->loadModule('deleteFirstContact');
     $this->loadModule('assertFalseFirstContact');
     $this->loadModule('closePhoneBook');
     
  }
  
  
  
  
}

startTest('DeletePerson' , $argv);
?>
