<?php
include_once ('error_reporting.php'); //Sets error level to E_ALL ^ E_NOTICE
require_once 'libs/BromineClassLoader.php';
session_name('Bromine');
session_start();
$dbh = new DBHandler();
$lh = new DBHandler($_SESSION['lang']);
$ut = $_SESSION['usertype'];
$sitename = substr(strrchr($_SERVER['PHP_SELF'], '/'), 1);
$lastgood = $_SESSION['lastgood'];
$protection = true;

if ($protection) {
    $result = $dbh->select('trm_usertype_access, trm_sites', "WHERE trm_usertype_access.ut_id='$ut' AND trm_sites.sitename='$sitename' AND trm_usertype_access.s_id=trm_sites.ID AND trm_usertype_access.access=1", '*');
    if (!mysql_num_rows($result) > 0) {
        if (strlen($lastgood) > 0) {
            header("Location: $lastgood?errormsg=Your usertype does not have access to this");
        } else {
            header("Location: login.php");
        }
        exit;
    }
}
if ((file_exists('install.php') || file_exists('sql.sql')) && !file_exists('im.dev')) {
    header("Location: login.php?errormsg=Please delete install.php and sql.sql");
    exit;
}
$_SESSION['lastgood'] = $sitename;
?>
