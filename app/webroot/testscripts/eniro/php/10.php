<?php

set_include_path(get_include_path() . PATH_SEPARATOR . "drivers/php");
require_once "Testing/Selenium.php";
require_once "Testing/BRUnit.php";
require_once "Testing/Dataparser.php";
require_once "ExcelReader/excel_reader2.php";

class AreaChooser extends BRUnit
{

  function testMyTestCase()
{  
    $dp = new Dataparser($this->orginalPath);
    $this->strippedURL = $dp->parseURL($this->sitetotest);
    $dp->getDataFromExcel($this->strippedURL);
    $this->uimap = $dp->uimap;
    $this->datamap = $dp->datamap;
    $this->selenium->open("/");
    $this->selenium->click($this->uimap['menu']['company tab']);
    $this->selenium->waitForPageToLoad($this->uimap['selenium']['timeout']);
    $this->selenium->click($this->uimap['company result page']['area chooser']);
    $this->selenium->waitForPageToLoad($this->uimap['selenium']['timeout']);
    $count = $this->selenium->getXpathCount($this->uimap['area chooser']['area count']);
    for($i = 1; $i < $count; $i++){
        $this->selenium->click(sprintf($this->uimap['area chooser']['area'], 83));
        $this->selenium->waitForPageToLoad($this->uimap['selenium']['timeout']);
        $this->assertTrue($this->selenium->isElementPresent($this->uimap['area chooser']['area name']));
        $areaname = $this->selenium->getText($this->uimap['area chooser']['area name']);
        $this->selenium->click($this->uimap['area chooser']['area name']);
        $this->selenium->waitForPageToLoad($this->uimap['selenium']['timeout']);
        $areaname = str_replace($this->uimap['area chooser']['choose area'], '',  $areaname);
        $this->customCommand($areaname,'done','','');
        $this->customCommand($this->selenium->getValue("where"),'done','','');
        try {
            
            $this->assertEquals($areaname, $this->selenium->getValue("where"));
            
        } catch (Exception $e) {}
        $this->selenium->goBack();
        $this->selenium->waitForPageToLoad($this->uimap['selenium']['timeout']);
        $subnameCount = $this->selenium->getXpathCount($this->uimap['area chooser']['area subname count']);

        for ($a = 1; $a < $subnameCount; $a++){


           $areasubname = $this->selenium->getText(sprintf($this->uimap['area chooser']['area subname'],$a));
           $temp2 = '';
           $temp = explode(' ', $areasubname);
           print_r($temp);
           $b = 0;
           foreach ($temp as $value){
            $b++;
            if ($b == 2) $temp2 .= $value;
            if ($b > 2) $temp2 .= ' ' . $value;
           }
           $areasubname = $temp2;
           $this->selenium->click(sprintf($this->uimap['area chooser']['area subname'],$a));
            $this->customCommand('Areasubname: ' . $areasubname,'done','','');
            $this->customCommand('Value from where: ' . $this->selenium->getValue("where"),'done','','');
            try {
            $this->assertEquals($areasubname, $this->selenium->getValue("where"));
            } catch (Exception $e) {}
            $this->selenium->goBack();
            $this->selenium->waitForPageToLoad($this->uimap['selenium']['timeout']);
        }
    }
    
    
  }
}
startTest("AreaChooser" , $argv);
?>
