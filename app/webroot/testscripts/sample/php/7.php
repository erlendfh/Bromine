<?php
set_include_path(get_include_path() . PATH_SEPARATOR . "drivers/php");
require_once "Testing/Selenium.php";
require_once "Testing/BRUnit.php";
require_once "Testing/Dataparser.php";
require_once "Testing/ModuleLoader.php";
require_once "ExcelReader/excel_reader2.php";

class AddPerson extends BRUnit
{

  function testMyTestCase()
  {
     $dp = new Dataparser($this->orginalPath);
     $this->strippedURL = $dp->parseURL($this->sitetotest);
     $dp->getDataFromExcel($this->strippedURL);
     $this->uimap = $dp->uimap;
     $this->datamap = $dp->datamap;
     $this->selenium->open("/");
     $this->loadModule('removePhoneBookCookie');
     $this->loadModule('peopleSearch');
     $this->loadModule('addFirstContact');
     $this->loadModule('openPhoneBook');
     $this->loadModule('verifyFirstContact');
     $this->loadModule('closePhoneBook');
  }
  
  
  
  
}

startTest('AddPerson' , $argv);
?>
