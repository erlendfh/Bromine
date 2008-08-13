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
$protection = 1;
/* Enable this when checking for W3 compliance
if($_SERVER['HTTP_USER_AGENT']=='W3C_Validator/1.575' || $_SERVER['HTTP_USER_AGENT']=='Jigsaw/2.2.5 W3C_CSS_Validator_JFouffa/2.0'){
$protection=0;
$_SESSION['auth'] = 'logged';
$_SESSION['user'] = 'admin';
$_SESSION['id'] = '104';
$_SESSION['usertype'] = '3';
$_SESSION['lang'] = 'dk';
$_SESSION['pass'] = '21232f297a57a5a743894a0e4a801fc3 ';
$_SESSION['usertypename'] = 'admin';
$_SESSION['p_id'] = '122';
$_SESSION['p_name'] = 'Sample';
$w3=true;
}
*/
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