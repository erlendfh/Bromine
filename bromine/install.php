<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title> Bromine installation </title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body id="install-page">
    <h2> Testing your setup... </h2>
    <br />
        <?php
        
        	// Set the same ini settings as in header.php
        	ini_set("max_execution_time", 61000);
        
        	// Setting up a few defaults, and remembering what the user wrote
            $xampp = array_key_exists('xampp', $_GET) ? $_GET['xampp'] : '';
            if($xampp){
                $_POST['username']='root';
                $_POST['database']='bromine';
                $_POST['password']='';
                $_POST['host']='localhost';
            }
            $username = array_key_exists('username', $_POST) ? $_POST['username'] : '';
            $database = array_key_exists('database', $_POST) ? $_POST['database'] : '';
            $password = array_key_exists('password', $_POST) ? $_POST['password'] : '';
            $host = array_key_exists('host', $_POST) ? $_POST['host'] : 'localhost';
            
            include ('libs/testBromine.php');
            $test = new testBromineInstallation();
            $results = $test->getResults();
            $i=0;
            echo "<table>";
            foreach($results['test'] as $test){
                $result = $results['result'][$i];
                echo "<tr>";
                echo "<td>$test</td>";
                echo "<td>$result</td>";
                echo "</tr>";
                $i++;
            }
            echo "</table>";
            
            
            if($results['failed']){
                echo "<h2>Setup will not continue untill the errors above have been corrected</h2>";
                exit;            
            }
        ?>
        <br />
        <h2>Ready to install!</h2> 
        <p>First, the installer will create a simple <code>config.php</code> file like this for you:</p>
        <pre>
        &lt;?php
        $this->username = "kenny";
        $this->database = "mybrominedatabase";
        $this->password = "secret";
        $this->host = "localhost";
        </pre>
        <p>When that's done, the installer will try to create all tables, using <a href="sql.sql" target="_blank">this SQL</a>. <strong>NB</strong>: Currently, Bromine supports only MySQL.</p>
        <?php 
            if($xampp){
                echo "<span class='status_passed'>You are using the one-click installer. The form below you is filled in correctly. Just press install</span>";    
            }else{
                echo "<p><span class='selected'>Enter your database information</span> below, and press Install. (All fields are required. Note if the database does not exist the installer will try to create it!)</p>";
            }
         ?>
        <form action='' method='post'>
          <table>
            <tr>
              <td><label for="theUsername">Username:</label></td> 
              <td><input id='theUsername' type='text' name='username' value='<?php echo $username ?>'></td>
            </tr>
            <tr>
              <td><label for="theDatabase">Database:</label> </td>
              <td><input id="theDatabase" type='text' name='database' value='<?php echo $database ?>'>
            </tr>
            <tr>
              <td><label for="thePassword">Password:</label> </td>
              <td><input id="thePassword" type='text' name='password' value='<?php echo $password ?>'></td>
            </tr>
            <tr>
              <td><label for="theHost">Host (usually <code>localhost</code>):</label></td>
              <td><input id="theHost" type='text' name='host' value='<?php echo $host ?>'></td>
            </tr>
            <tr>
              <td colspan="2" style="text-align:right;">
                <input type='hidden' value='1' name='action'>
                <input type='submit' value='Install'>
              </td>
            </tr>
          </table>
        </form>

        <?php
        function multiple_query($q, $link) {
            $tok = strtok($q, ";");
            while ($tok) {
                $results = mysql_query("$tok", $link) or die("<p><strong>Sorry, there was a problem with the installation.</strong> Check your Username/Database/Password/Host. <span class='mysql-error'>(" . mysql_error() . ")</span></p></body></html>");
                $tok = strtok(";");
            }
            return $results;
        }
        if (array_key_exists('action', $_POST) && $_POST['action'] == '1' || $_GET['test']) {
            $username = $_POST['username'];
            $database = $_POST['database'];
            $password = $_POST['password'];
            $host = $_POST['host'];
            $query = trim(file_get_contents('sql.sql'));
            $myFile = "config.php";
            $fh = fopen($myFile, 'w') or die("<p>Can't create file config.php, check your permissions.</p></body></html>");
            $stringData = '$this->username = "' . $username . '";
            $this->database = "' . $database . '";
            $this->password = "' . $password . '";
            $this->host = "' . $host . '";';
            fputs($fh, "<?php\n");
            fputs($fh, $stringData);
            fputs($fh, "?" . ">\n");
            fclose($fh);
            $db = mysql_connect($host, $username, $password);
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
            
            echo "<h2>Install complete</h2>
            Below is the username and password for your first login:
            <br />
            <br />
            <table>
              <tr>
                <td><b>Username:</b></td>
                <td>admin</td>
              </tr>
              <tr>
                <td><b>Password:</b></td>
                <td>admin</td>
              </tr>
            </table>
            <p>User forums can be found here: <a href='http://clearspace.openqa.org/community/bromine'>http://clearspace.openqa.org/community/bromine</a></p>
            <p>Documentation can be found here: <a href='http://wiki.openqa.org/display/BR/Home'>http://wiki.openqa.org/display/BR/Home</a></p>
            <h2><a href='login.php?finishinstall=1&errormsg=login with username: admin and password: admin. First time you login Bromine will register itself'>Click here to continue</a></h2>";
        }
        ?>
    </body>
</html>

