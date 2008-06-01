<?php
include_once('protected.php');

$t_id=$_GET['t_id'];
$td_id=$_GET['td_id'];
$cd_id=$_GET['cd_id'];
$c_id=$_GET['c_id'];
$s_id=$_GET['s_id'];
$time=$_SESSION['startTimeMan'];
$status=$_GET['status'];
$i=$_GET['i']+1;
$action = $_GET['action'];
$reaction = $_GET['reaction'];

$time = time() - $time;

/*
    numTestPassed,
    numTestFailed,
    numCommandsPassed,
    numCommandsFailed,
    numCommandsErrors,
    */

//$dbh->insert('TRM_manual_commands',"NULL,'$status',$cd_id,$t_id","ID,status,cd_id,t_id");
/*
$result = $dbh->sql("SELECT action, reaction FROM TRM_design_manual_commands WHERE id = $c_id");

$action = mysql_result($result, 0, 'action');
$reaction = mysql_result($result, 0, 'reaction');
*/
$dbh->sql("REPLACE INTO TRM_commands VALUES ('$c_id', '$status','$action', '$reaction','',$t_id)");


$numCommandsPassed = mysql_result($dbh->sql("SELECT count(*)
FROM TRM_commands
WHERE t_id = $t_id
AND STATUS = 'passed'"),0); 

$numCommandsFailed = mysql_result($dbh->sql("SELECT count(*)
FROM TRM_commands
WHERE t_id = $t_id
AND STATUS = 'failed'"),0); 

$numCommandsErrors = mysql_result($dbh->sql("SELECT count(*)
FROM TRM_commands
WHERE t_id = $t_id
AND STATUS = 'notdone'"),0); 

/*
$countresult = $dbh->sql("
SELECT * FROM ((SELECT COUNT(*) as failed FROM TRM_commands WHERE status='failed' AND WHERE t_id = $t_id) as t1,
(SELECT COUNT(*) as passed FROM TRM_commands WHERE status='passed' AND WHERE t_id = $t_id) as t2,
(SELECT COUNT(*) as notdone FROM TRM_commands WHERE status='notdone' AND WHERE t_id = $t_id) as t3)");
$numCommandsPassed=mysql_result($countresult, 0, 'passed');
$numCommandsFailed=mysql_result($countresult, 0, 'failed');
$numCommandsErrors=mysql_result($countresult, 0, 'notdone');
*/
if ($numCommandsFailed>0){
  $dbh->sql("
  UPDATE TRM_suite SET 
  numTestFailed = '1', 
  numTestPassed = '0',
  timeTaken = $time
  WHERE id=$s_id");
  
  $dbh->sql("
  UPDATE TRM_test SET 
  status = 'failed'
  WHERE id=$t_id");
}
else{
  $dbh->sql("
  UPDATE TRM_suite SET 
  numTestFailed = '0', 
  numTestPassed = '1',
  timeTaken = $time
  WHERE id=$s_id");  

  $dbh->sql("
  UPDATE TRM_test SET 
  status = 'passed'
  WHERE id=$t_id");
}

$dbh->sql("
UPDATE TRM_suite SET 
numCommandsPassed = $numCommandsPassed, 
numCommandsFailed = $numCommandsFailed, 
numCommandsErrors = $numCommandsErrors 
WHERE id=$s_id");

header ("location: manualControl.php?td_id=$td_id&t_id=$t_id&i=$i&s_id=$s_id");
?>
