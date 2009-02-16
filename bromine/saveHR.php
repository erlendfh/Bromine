<?php include ('protected.php'); ?>
<?php
//print_r($GLOBALS['_POST']);
$p_id = $_POST['p_id'];
$u_id = $_POST['u_id'];
$dbh = new DBHandler();
//ProjectList UPDATER (Set everyones access on the given p_id to 0, then set the ones suplied by u_id to 1)
$dbh->update('trm_projectlist', "access = '0'", "projectID = '$p_id'");
for ($i = 0;$i < count($u_id);$i++) {
    $dbh->update('trm_projectlist', "access = '1'", "userID = '$u_id[$i]' AND projectID = '$p_id'");
}
header("Location: editHR.php?p_id=$p_id");
?>
