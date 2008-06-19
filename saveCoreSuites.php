<?php include ('protected.php'); ?>
<?php
$p_id = $_SESSION['p_id'];
$core_t_id = $_POST['core_t_id'];
$core_testsuite = $_POST['core_testsuite'];
$newcore_testsuite = $_POST['newcore_testsuite'];
//CORE UPDATER
for ($i = 0;$i < count($core_t_id);$i++) {
    $dbh->update('TRM_core_testsuites', "testsuite = '$core_testsuite[$i]'", "ID = '$core_t_id[$i]'");
}
//CORE INSERTER
if (strlen($newcore_testsuite) > 0) {
    $dbh->insert('TRM_core_testsuites', "NULL,'$p_id','$newcore_testsuite'", 'id, p_id, testsuite');
}
header("Location: editCoreSuites.php");
?>
