<?php
require_once 'libs/BromineClassLoader.php';
include_once ('error_reporting.php'); //Sets error level to E_ALL ^ E_NOTICE
//Custom protection similar to protected.php.
//The usual protected.php could not be used due
//to race conditions
include_once ('inputHandler.php');
$user = $_GET['user'];
$pass = $_GET['pass'];
$dbh = new DBHandler();
$referer = $_SERVER['HTTP_REFERER'];
$sitename = substr(strrchr($_SERVER['PHP_SELF'], '/'), 1);
$referersite = substr(strrchr($_SERVER['HTTP_REFERER'], '/'), 1);
$access = false;
$preresult = $dbh->select('TRM_users', "WHERE name='$user'", '*');
$num = mysql_numrows($preresult);
for ($i = 0;$i < $num;$i++) {
    $dbpass = mysql_result($preresult, $i, "password");
    if (md5($dbpass) == $pass) {
        $ut = mysql_result($preresult, $i, "usertype");
        $access = true;
    }
}
if ($access) {
    $result = $dbh->select('TRM_usertype_access, TRM_sites', "WHERE TRM_usertype_access.ut_id='$ut' AND TRM_sites.sitename='$sitename' AND TRM_usertype_access.s_id=TRM_sites.ID AND TRM_usertype_access.access=1", '*');
    $refererresult = $dbh->select('TRM_usertype_access, TRM_sites', "WHERE TRM_usertype_access.ut_id='$ut' AND TRM_sites.sitename='$referersite' AND TRM_usertype_access.s_id=TRM_sites.ID AND TRM_usertype_access.access=1", '*');
    if (!mysql_num_rows($result) > 0) {
        if (mysql_num_rows($refererresult) > 0) {
            if (strpos($referer, '?') !== FALSE) {
                header("Location: $referer&errormsg=Your usertype does not have access to this");
            } else {
                header("Location: $referer?errormsg=Your usertype does not have access to this");
            }
        } else {
            header("Location: login.php");
        }
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
if (file_exists('install.php') || file_exists('sql.sql')) {
    header("Location: login.php?errormsg=Please delete install.php and sql.sql");
    exit;
}
?>
