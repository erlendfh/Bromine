<?php include 'protected.php'; ?>
<?php

$sitetotest= $_GET['sitetotest'];
$OS = $_GET['OS'];
$browser = $_GET['browser'];
$td_id = $_GET['td_id'];
$p_id=$_SESSION['p_id'];


if ($sitetotest != '' && $OS != '' && $browser != '' &&  $td_id != '' && $p_id != ''){
  $_SESSION['startTimeMan'] =time();
  $suitename= mysql_result($dbh->sql("SELECT name FROM TRM_design_manual_test WHERE id=$td_id"),0);
  // SKAL OPRETTE SUITE/TES I DB'en
  $s_id=$dbh->insert('TRM_suite',
      "
      NULL,  
      '$suitename',
      '$sitetotest',
      '$status',
      '".date('Y-m-d H:i:s')."',
      '$timeTaken',
      '$browser',
      '$OS',
      'Manual Test',
      '',
      '$noOfPassedTest',
      '$noOfFailedTest',
      '$noOfCommandsPassed',
      '$noOfCommandsFailed',
      '0',
      '$p_id'"
      ,
      "
      ID,
      suitename,
      environment,
      status,
      timeDate,
      timeTaken,
      browser,
      platform,
      selenium_version,
      selenium_revision,
      numTestPassed,
      numTestFailed,
      numCommandsPassed,
      numCommandsFailed,
      numCommandsErrors,
      p_id
      "
      
      );
      
    $name = $suitename;  
    $status = "failed";
    $tHelp = 'intet hjælp';
    $t_id=$dbh->insert('TRM_test',
      "
      NULL,
      '$status',
      '$name',  
      '$s_id',
      '$tHelp'
      ",
      "
      ID,
      status,
      name,
      s_id,
      Thelp
      ");
      header ("location: manualtest.php?sitetotest=$sitetotest&t_id=$t_id&td_id=$td_id&s_id=$s_id");
      exit;
}
header ('location: manualRunner.php');
exit;

?>
