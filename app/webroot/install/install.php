<?php

session_start();
/*
lav en db forbindelse
kør SQL
kør state of the union
opret admin bruger
slet denne install mappe
*/

echo "This will install Bromine 3<br />";

$_SESSION['steps'] = 5;

if (empty($_POST)){

?>
<form action="#" name="step1_form" method="post"><br>
    <label for="host">Host:</label>
    <input name='host' type="text" tabindex="1" size="30"><br>
    <label for="login">login:</label>
    <input name='login' type="text" tabindex="2" size="30"><br>
    <label for="password">password:</label>
    <input name='password' type="text" tabindex="3" size="30"><br>
    <label for="database">database:</label>
    <input name='database' type="text" tabindex="4" size="30"><br>
    <label for="prefix">prefix:</label>
    <input name='prefix' type="text" tabindex="5" size="30"><br>
    <input type="submit">
    
</form>
<?php } else{

    $host = $_POST['host'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $database = $_POST['database'];
    
    $_SESSION['host'] = $host;
    $_SESSION['login'] = $login;
    $_SESSION['password'] = $password;
    $_SESSION['database'] = $database;
   
    $connect = mysql_connect($host, $login, $password) or die(mysql_error());
    
    if (connect){
        $dbFile = getcwd(). '\\..\\..\\config\\db.php';
        $fh = fopen($dbFile, 'w') or die("can't open file");
        $stringData = "
<?php
class DATABASE_CONFIG {

	var \$default = array(
		'driver' => 'mysql',
		'persistent' => false,
		'host' => '$host',
		'login' => '$login',
		'password' => '$password',
		'database' => '$database',
		'prefix' => '',
	);
	
?>
        ";
        fwrite($fh, $stringData);
        fclose($fh);
        echo "Database connection saved!";
        echo "<a href='step2.php'>Continue</a>";
    }else{
        echo "Could not connect to your database!";
        echo "<br /><a href=''>Retry</a> or <a href='step2.php'>Continue</a>";
    }
  
}
?>