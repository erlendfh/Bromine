<?php
session_start();
echo "Step 2";
function multiple_query($q, $link) {
    $tok = strtok($q, ";");
    while ($tok) {
        $results = mysql_query("$tok", $link) or die("<p><strong>Sorry, there was a problem with the installation.</strong> Check your Username/Database/Password/Host. <span class='mysql-error'>(" . mysql_error() . ")</span></p></body></html>");
        $tok = strtok(";");
    }
    return $results;
}

$host = $_SESSION['host'];
$login = $_SESSION['login'];
$password = $_SESSION['password'];
$database = $_SESSION['database'];

$query = trim(file_get_contents('bromine.sql'));

$db = mysql_connect($host, $login, $password);
if (!$db) {
    die("<p><strong>Sorry, there was a problem with the installation.</strong> Check your Username/Password/Host. <span class='mysql-error'>(" . mysql_error() . ")</span></p>");
}

$status = mysql_select_db($database, $db);

if (!$status) {
    $sql = "CREATE DATABASE $database";
    $status = mysql_query($sql, $db);
    $status = mysql_select_db($database, $db);
    if (!$status) {
        die("<p><strong>Sorry, there was a problem with the installation.</strong>The selected database did not exist and the installer was unable to create it.<span class='mysql-error'>(" . mysql_error() . ")</span><");
    }
}
multiple_query($query, $db);

echo "Database succesful installed.<br />";
echo "<br /><a href=''>Retry</a> or <a href='http://$host'>Continue</a>";



?>