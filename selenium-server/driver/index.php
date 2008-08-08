<?php

$fp = fopen('log.txt', 'a');
fwrite($fp, "KK ");
fclose($fp);

$cmd = $_GET['cmd'];
$one = $_GET['1'];
$two = $_GET['2'];
$sessionId = $_GET['sessionId'];

$url = "http://localhost:4444/selenium-server/driver/?cmd=$cmd&1=$one&2=$two&sessionId=$sessionId";

$handle = fopen($url, 'r');
stream_set_blocking($handle, false);
$response = stream_get_contents($handle);
fclose($handle);

echo $response;

?>
