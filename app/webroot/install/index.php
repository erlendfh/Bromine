<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
        <title>
            Bromine 3 Installation
        </title>
        <link rel="stylesheet" type="text/css" href="../css/green/style.css" />
        <link rel="stylesheet" type="text/css" href="../css/green/color.css" />
        <link rel="stylesheet" type="text/css" href="../css/green/content.css" />
        
    </head>
    <body>
  <div id="main">
  <div id="links_container">
      <div id="logo"><h1>Bromine 3</h1><img id='notification' src='img/ajax-loader.gif' alt="" style='display: none;'/></div>
      <div id="links">
      </div>
    </div>
    <div id="content">
      <div id="column2">
        <div id='messages'>
        </div>
        <?php
 
    if ($_GET['page'] == 'step1' || $_GET['page'] == ''){
    /*
    lav en db forbindelse
    kør SQL
    kør state of the union
    opret admin bruger
    slet denne install mappe
    */
    $dbFile = getcwd(). '/../../config/database.php';
    echo "<h1>This will install Bromine 3</h1><br>";
    echo "<h2>Step 1: Database infomation</h2>";
    $_SESSION['steps'] = 5;
    
    if (empty($_POST)){
    
    if (is_file($dbFile)){
        echo "<p class='warning'>You already have a database.php in /config dir. This installation will overwrite this file!</p><br>";
    }
    ?>
    <form action="#" name="step1_form" method="post">
        <table>
            <tr>
                <td><label for="host">Host:</label></td><td><input name='host' type="text" tabindex="1" size="30"></td>
            </tr>
            <tr>
                <td><label for="login">Username:</label></td><td><input name='login' type="text" tabindex="2" size="30"></td>
            </tr>
            <tr>
                <td><label for="password">Password:</label></td><td><input name='password' type="text" tabindex="3" size="30"></td>
            </tr>    
            <tr>
                <td><label for="database">Database name:</label></td><td><input name='database' type="text" tabindex="4" size="30"></td>
            </tr>
            <!--tr>
                <td><label for="prefix">prefix:</label></td><td><input name='prefix' type="text" tabindex="5" size="30"><br></td>
            </tr-->
            <tr>
                <td><input type="submit" value='Save'></td>
            </tr>
        </table>
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
       
        $connect = @mysql_connect($host, $login, $password);
        
        if ($connect){
            
            $fh = fopen($dbFile, 'w') or die("can't open file");
            $stringData = "<?php
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
                            }
                            ?".">";
            fwrite($fh, $stringData);
            fclose($fh);
            echo "<b>Database connection succesful.</b><br />";
            echo "<b>Database info saved! Click continue to install the bromine.sql file.</b><br><br>";
            echo "<h2><a href='?page=step2'>Continue</a><h2>";
        }else{
            echo "Could not connect to your database! Error: ".mysql_error();
            echo "<br /><a href='?page=step1'>Retry</a> or <a href='?page=step2'>Continue</a>";
        }
      
    }
    }
    elseif($_GET['page'] == 'step2'){
        echo "<h1>This will install Bromine 3</h1><br>";
        echo "<h2>Step 2: Setting up database</h2>";
        function multiple_query($q, $link) {
            $tok = strtok($q, ";");
            while ($tok) {
                $results = @mysql_query("$tok", $link) or die("<p><strong>Sorry, there was a problem with the installation.</strong> Check your Username/Database/Password/Host. <span class='mysql-error'>(" . mysql_error() . ")</span></p></body></html>");
                $tok = strtok(";");
            }
            return $results;
        }
        
        $host = $_SESSION['host'];
        $login = $_SESSION['login'];
        $password = $_SESSION['password'];
        $database = $_SESSION['database'];
        
        $query = trim(file_get_contents('bromine.sql'));
        
        $db = @mysql_connect($host, $login, $password);
        if (!$db) {
            die("<p><strong>Sorry, could not connect to the MySQL server. <span class='mysql-error'>(" . mysql_error() . ")</span></p>");
        }
        
        $status = @mysql_select_db($database, $db);
        
        if (!$status) {
            $sql = "CREATE DATABASE $database";
            $status = @mysql_query($sql, $db);
            if (!$status) {
                die("<p><strong>Sorry, there was a problem with the installation.</strong>The selected database did not exist and the installer was unable to create it.<span class='mysql-error'>(" . mysql_error() . ")</span><");
            }
            $status = @mysql_select_db($database, $db);
            if (!$status) {
                die("<p><strong>Sorry, there was a problem with the installation.</strong>The selected database did not exist and the installer was unable to create it.<span class='mysql-error'>(" . mysql_error() . ")</span><");
            }
        }
        multiple_query($query, $db);
        
        echo "<br /><b>Database succesful installed.</b><br />";
        echo "<b>Please delete /install dir.</b><br />";
        //$server = $_SERVER['SERVER_NAME'];
        
        echo "<br><br><h2>Login with this user:</h2>";
        echo "
        <dl>
            <dt>User:</dt>
            <dd>admin</dd>
            <dt>Password:</dt>
            <dd>admin</dd>
        </dl>";
        echo "<br /><h2><a href='/configs/stateOfTheSystem'>Continue</a></h2>";
        
        }
    ?>
      </div>
    </div>
    <div id="footer">
        Copyright &copy; 2007-2009 Bromine Team | <a href="http://bromine.seleniumhq.org">Bromine</a> | <a href="http://www.dcarter.co.uk">Design by dcarter</a>
    </div>
    <div id="debug">
    <?php echo $cakeDebug; ?>
    </div>
  </div>
</body>
</html>
