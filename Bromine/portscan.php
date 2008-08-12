<?php
require "error_reporting.php";
require_once 'libs/BromineClassLoader.php';

$host = $_GET['host'];
$port = BromineUtilities::arrayGet('port', $_GET, false);
$timeout = BromineUtilities::arrayGet('timeout', $_GET, false); 

if ($host) {
    if ($port && $timeout) {
        $msg = BromineUtilities::checkJavaServer($host, $port, $timeout);
    } elseif ($port) {
        $msg = BromineUtilities::checkJavaServer($host, $port);
    } else {
        $msg = BromineUtilities::checkJavaServer($host);
    }
}
if ($msg === true) {
    echo "<img src='img/online.ico' width='15' height='15' alt='online' title='Online'/>";
} else {
    echo "<img src='img/offline.ico' width='15' height='15' alt='offline' title='$msg'/>";
}
?> 
