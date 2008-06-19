<?php
require "error_reporting.php";
function checkJavaServer($host, $port = 4444, $timeout = 1) {
    $fp = @fsockopen($host, $port, $errno, $errstr, $timeout);
    if ($fp) {
        fclose($fp);
        flush();
        return true;
    } else {
        flush();
        return $errstr;
    }
}
$host = $_GET['host'];
$port = $_GET['port'];
$timeout = $_GET['timeout'];
if ($host) {
    if ($port && $timeout) {
        $msg = checkJavaServer($host, $port, $timeout);
    } elseif ($port) {
        $msg = checkJavaServer($host, $port);
    } elseif ($portscan) {
        $msg = checkJavaServer($host, 4444, $timeout);
    } else {
        $msg = checkJavaServer($host);
    }
}
if ($msg === true) {
    echo "<img src='img/online.ico' WIDTH='15' HEIGHT='15' alt='online' title='Online'/>";
} else {
    echo "<img src='img/offline.ico' WIDTH='15' HEIGHT='15' alt='offline' title='$msg'/>";
}
?> 
