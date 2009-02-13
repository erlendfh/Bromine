<?php
sleep(rand(5,5));

$myFile = "logs/log".$argv[1].".txt";
$fh = fopen($myFile, 'a') or die("can't open file");
$stringData = rand(0,99999999999999)."\n";
fwrite($fh, $stringData);
fclose($fh);
?>
