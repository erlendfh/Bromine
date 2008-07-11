<?php
  /*
    TODO liste:
    
    * Tilføj test til array $tests
    * Sæt suitenavn i linien:  $suite = new Suite('BagerSuite', $site....
  */


  /*
    Placeringen af suite.php...
  */
  include "suite.php";
  /*
  echo "<pre>";
  print_r($_REQUEST);
  echo "</pre>";
  */
  /*
  Array list af test der skal køres i denne suite!
  Klasse og fil navn skal være identisk, dvs. BagerTest hedder BagerTest.php og klassen i filen hedder BagerTest
  Indtastes UDEN .php endelsen
  HUSK: Case sensitive  
  */
  $ntest = false;
  if(isset($_GET['tests'])){
    if (is_array($_GET['tests'])){
      $tests = $_GET['tests']; 
    }
    else{
      $tests = array($_GET['tests']);
    }
    $ntest = true;
  }
  
  //Datatest Kneppes motorsavsmasakre!
  $datatest = false;
  if(isset($_GET['datafile'])){
    if (is_array($_GET['datafile'])){
      $datafile = $_GET['datafile']; 
      //print_r($datafile);
    }
    else{
      $datafile = array($_GET['datafile']);
    }
    $datatest = true;
  }
  /* Using old textparser
  $datatest = false;
  if(isset($_GET['datafile'])){
    echo "i think it's a datatest";
    include "TextFileParser.php";
    $file = $_GET['datafile'];
    $tfp = new TextFileParser($file, $_GET['p_name']);
    $dos = $tfp->load();
    $file = strtolower($tfp->get('type'));
    $dTest = trim("dataTest".$file);
    $datatest = true;
  }
  */
  //$autoName = implode(",", $tests);
  /*
    Alt der der sende fra Bromine
  */
  $suitename = $_GET['suitename'];
  $returnTo = $_GET['returnTo'];
  $type = $_GET['type'];
  $p_name = $_GET ['p_name'];
  $u_id = $_GET['u_id'];

  /*
    Opretter nye objekt af klassen Suite, som kaldes med de parameter som der sendes til denne suite i GET'
    'BagerSuite' er navnet på denne suite!
  */
  
  $suite = new Suite($suitename);//, $siteToTest, $browser, $OS, $p_id, $logFile);
  $s_id = $suite->createSuite();
  /*
    Selv udførslen af suiten/testene
  */
  $countTests = 0;
  $countCommands = 0;
  
  if($ntest == true && $datatest == false){

    for ($i = 0;$i<count($tests);$i++){
      if(file_exists("../../$type/$p_name/".$tests[$i].".php")){
      include_once "../../$type/$p_name/".$tests[$i].".php";  
      try{
        $bt[$i] = new $tests[$i]();
        $bt[$i]->setUp($s_id);
        $bt[$i]->testMyTestCase();
        $result = $bt[$i]->tearDown();
        $test = $result->getTest();
        $countCommands += $test->countCommands();
        $suite->addTest($test);
        $countTests++;
      }
      catch(Exception $e){}
      }
      else{echo "File ../../$type/$p_name/$tests[$i].php does not exist!";}
    }
  }

  if($ntest == true && $datatest == true){
    for ($i = 0;$i<count($tests);$i++){
      if(file_exists("../../$type/$p_name/".$tests[$i].".php")){
      include_once "../../$type/$p_name/".$tests[$i].".php";  
      try{
        $dt[$i] = new $tests[$i]();
        $dt[$i]->setUp($s_id, "../../$type/$p_name/data/".$datafile[$i]);
        $dt[$i]->testMyTestCase();
        $result = $dt[$i]->tearDown();
        $test = $result->getTest();
        $countCommands += $test->countCommands();
        $suite->addTest($test);
        $countTests++;
      }
      catch(Exception $e){echo "Most likely some of your tests aren't datatests.";}
    }
  }
  }

  
  /* Using old textfileparser
  // Mere datatest crap
  if($datatest == true){
    for ($x = 0; $x<count($dos);$x++){
      if(file_exists("../../$type/$p_name/".$dTest.".php")){
        include_once "../../$type/$p_name/".$dTest.".php";  
        $find = $dos[$x][0];
        $arrayOfSearchWords = $dos[$x];
        $dt = new DataTest();
        $dt->setUp($s_id, "Datatest $file: $find",$find,$arrayOfSearchWords);
        $dt->testMyTestCase();
        $result = $dt->tearDown();
        $test = $result->getTest();
        $test->setTHelp($tfp->get('description'));  
        $suite->addTest($test);
        $countCommands += $test->countCommands();
        $countTests++;
      }
    }
  }
  */
  $suite->finalizeSuite($countTests, $countCommands);


  
 
  
?>
