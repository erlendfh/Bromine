<?php include ('protected.php'); ?>
<?php
  //print_r($GLOBALS['_POST']);
  
  $ut_id=$_POST['ut_id'];
  $uta_id=$_POST['uta_id'];
  $access=$_POST['access'];
  
  $dbh= new DBHandler();
  
  //ProjectList UPDATER (Set everyones access on the given p_id to 0, then set the ones suplied by u_id to 1)
  $dbh->update('TRM_usertype_access',"access = '0'","ut_id = '$ut_id'");
  for($i=0;$i<count($uta_id);$i++){
    $dbh->update('TRM_usertype_access',"access = '1'","ID = '$uta_id[$i]'");
  }
  header("Location: editUserTypeAccess.php?ut_id=$ut_id");
?>
