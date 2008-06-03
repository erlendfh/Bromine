<?php include ('protected.php'); ?>
<?php
  //print_r($GLOBALS['_POST']);


    $p_id=$_POST['p_id'];
    
    $c_id=$_POST['c_id'];
    $core_referer=$_POST['core_referer'];
    $TestRunnerLocation=$_POST['TestRunnerLocation'];
    $testPath=$_POST['testPath'];
    
    $newcore_referer=$_POST['newcore_referer'];
    $newTestRunnerLocation=$_POST['newTestRunnerLocation'];
    $newtestPath=$_POST['newtestPath'];
    
    $dbh= new DBHandler();
    
    //CORE UPDATER
    for($i=0;$i<count($c_id);$i++){
      $dbh->update('TRM_core',"referer = '$core_referer[$i]', TestRunnerLocation='$TestRunnerLocation[$i]', testPath='$testPath[$i]'","ID = '$c_id[$i]'");
    }
    //CORE INSERTER
    if(strlen($newcore_referer)>0 && strlen($newTestRunnerLocation)>0 && strlen($newtestPath)>0){
      $newid = $dbh->insert('TRM_core',"NULL,'$newcore_referer','$p_id','$newTestRunnerLocation','$newtestPath'",'ID,referer, p_id, TestRunnerLocation, testPath');
    }

    
  header ("Location: editSites.php?p_id=$p_id#$newid");
  
?>
