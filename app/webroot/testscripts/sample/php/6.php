<?php

require_once "Selenium.php";

class Example 
{
  function setUp($s_id)
  {
    $this->selenium = new Testing_Selenium($s_id, $_GET["browser"], $_GET["sitetotest"], get_class($this), $_GET["host"]);
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
        $numbers=array(
        '3000',
        '2200',
        /*
        '5000',
        '4000',
        '6000',
        '7000',
        '8000',
        '9000',
        '3310',
        '2800',
        '2900',
        */
        '6300'
        );
        
        $modes=array(
        'standard',
        'aerial',
        'hybrid'
        );
        
        foreach($numbers as $number){
            foreach($modes as $mode){
                $this->selenium->open("/kort/");
                $this->selenium->waitForPageToLoad("30000");
                sleep(2);
                $this->selenium->click("//li[@id='$mode']/a");
                for ($second = 0; ; $second++) {
                          if ($second >= 60) $this->fail("timeout");
                          try {
                                   if (!$this->selenium->silentIsVisible("time-indicator")) break;
                          } catch (Exception $e) {}
                          sleep(1);
                     }
                sleep(2);
                $this->selenium->type("where", "$number");
                $this->selenium->click("//input[@value='Søg']");
                for ($second = 0; ; $second++) {
                          if ($second >= 60) $this->fail("timeout");
                          try {
                                   if (!$this->selenium->silentIsVisible("time-indicator")) break;
                          } catch (Exception $e) {}
                          sleep(1);
                     }
                sleep(2);
                $count=$this->selenium->getXpathCount("//img[@class='tile']");
                if($count>24){
                    $this->selenium->customCommand('verifyXpathCount',"//img[@class='tile']","$count>24",'passed');
                    for($i=1;$i<36;$i++){
                        
                        if(preg_match("/$mode/",$this->selenium->getAttribute("//img[@class='tile'][$i]@src"))){
                            $this->selenium->customCommand('verifyAttribute',"//img[@class='tile'][$i]@src","regexp:$mode",'passed'); 
                        }else{
                            $this->selenium->customCommand('verifyAttribute',"//img[@class='tile'][$i]@src","regexp:$mode",'failed');
                        }
                        sleep(1);
                    }
                }else{
                     $this->selenium->customCommand('verifyXpathCount',"//img[@class='tile']","$count<24",'failed');
                }
                //Ville lave tjek her på om der var over 24 tiles og at der i src var f.eks. normal/aerial/combi
            }
        }
    }
    catch(Exception $e){}
  }
}
?>
