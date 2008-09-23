<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>
      Bromine installation
    </title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body id="install-page">
  <h1>Installing Bromine</h1>
  <p>First, the installer will create a simple <code>config.php</code> file like this for you:</p>
  <pre>
  &lt;?php
  $this->username = "kenny";
  $this->database = "mybrominedatabase";
  $this->password = "secret";
  $this->host = "localhost";
  </pre>
  <p>When that's done, the installer will try to create all tables, using <a href="sql.sql">this SQL</a>. <strong>NB</strong>: Currently, Bromine supports only MySQL.</p>
  <hr />
<?php



$prereqs = array();
$fulfilledPrereqs = array();
$isReadyToInstall = true;
if (!is_writable('.')) {
    $prereqs[] = array('Please make the current folder writable', false);
    $isReadyToInstall = false;
} else {
    $prereqs[] = array('Current folder is writable', true);
}
if (!$isReadyToInstall) {
    echo '<h2>Checking install readiness...</h2><ul id="install-prereqs">';
    foreach($prereqs as $requirement) {
        $class = $requirement[1] ? 'prereq-passed' : 'prereq-needed';
        $symbol = $requirement[1] ? '<span style="color:green;">&#10004;</span>' : '<span style="color:red;">&#10008;</span>';
        echo "<li class='$class'>$symbol {$requirement[0]} </li>";
    }
    echo '</ul>';
}
if (!$isReadyToInstall) {
    die('<p><strong>Sorry, can not install.</strong> Please fulfil the above requirements to continue installation.</p></body></html>');
}
// Setting up a few defaults, and remembering what the user wrote
$username = array_key_exists('username', $_POST) ? $_POST['username'] : '';
$database = array_key_exists('database', $_POST) ? $_POST['database'] : '';
$password = array_key_exists('password', $_POST) ? $_POST['password'] : '';
$host = array_key_exists('host', $_POST) ? $_POST['host'] : 'localhost';
?> 
  <p><strong>Ready to install!</strong> <span class="selected">Enter your database information</span> below, and press Install. (All fields are required. Note if the database does not exist the installer will try to create it!)</p>
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
if (array_key_exists('action', $_POST) && $_POST['action'] == '1') {
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
    
    include ('libs/testBromine.php');
    
    echo "<br><br>Install complete<br />Now login with the following information:
    <table>
      <tr>
        <td>Username:</td>
        <td>admin</td>
      </tr>
      <tr>
        <td>Password:</td>
        <td>admin</td>
      </tr>
    </table><br />
    <p>User forums can be found here: <a href='http://clearspace.openqa.org/community/bromine'>http://clearspace.openqa.org/community/bromine</a></p>
    <br />
    <p>Documentation can be found here: <a href='http://wiki.openqa.org/display/BR/Home'>http://wiki.openqa.org/display/BR/Home</a></p>
    <br />
    <a href='finished.php'>Click here to continue</a>";
}
?>
</body>
</html>

