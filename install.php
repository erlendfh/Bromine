<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>
      Bromine installation
    </title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
  
  Fill out the form below and press Install. If everything goes well you should get an "Install complete"
  <br><br>
    <form action='' method='post'>
      <table>
        <tr>
          <td>Username:</td> 
          <td><input type='text' name='username'></td>
        </tr>
        <tr>
          <td>Database: </td>
          <td><input type='text' name='database'></td>
        </tr>
        <tr>
          <td>Password: </td>
          <td><input type='text' name='password'></td>
        </tr>
        <tr>
          <td>Host: (usually 'localhost')</td>
          <td><input type='text' name='host'></td>
        </tr>
        <tr>
          <td>
            <input type='hidden' value='1' name='action'>
            <input type='submit' value='Install'>
          </td>
          <td></td>
        </tr>
      </table>
    </form>
  </body>
</html>

<?php

function multiple_query($q,$link) {
  $tok = strtok($q, ";");
  while ($tok) {
      $results=mysql_query("$tok",$link) or die(mysql_error()." Check your Username/Database/Password/Host");
      $tok = strtok(";");
  }
  return $results;
}

if($_POST['action']=='1'){

  $username=$_POST['username'];
  $database=$_POST['database'];
  $password=$_POST['password'];
  $host=$_POST['host'];
  
  $query=trim(file_get_contents('sql.sql'));

  $myFile = "config.php";
  $fh = fopen($myFile, 'w') or die("Can't create file config.php, check your permissions");
  $stringData = 
      '$this->username="'.$username.'";
      $this->database = "'.$database.'";
      $this->password="'.$password.'";
      $this->host = "'.$host.'";';
  
  
  fputs($fh, "<?php\n");
  fputs($fh, $stringData);
  fputs($fh, "?>\n");
  fclose($fh);
  
  
  $db=mysql_connect($host, $username, $password);
  mysql_select_db($database, $db);
  
  multiple_query($query,$db);
  
  echo "Install complete";
}



?>

