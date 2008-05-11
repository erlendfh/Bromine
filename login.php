<?php

  //Handles login/logout. Login is session based. If nothing passed to login.php it shows login form. 
  include_once ("DBHandler.class.php");
  $dbh = new DBHandler();
  $name=$_REQUEST['name'];
  $pass=$_REQUEST['pass'];
  $lang=$_REQUEST['language'];
  $action=$_REQUEST['action'];
  
  if ($name != "" && $pass != ""){
    $result = $dbh->select('TRM_users',"WHERE name='$name' AND password LIKE BINARY '$pass' AND usertype > 2",'*');
    $num=mysql_numrows($result);
    if ($num > 0){
      $id = mysql_result($result, 0, 'id');
  	  $usertype = mysql_result($result, 0, 'usertype');
  	  $lastLogin = mysql_result($result, 0, 'lastLogin');
  	  session_name('Bromine');
  	  session_start();
      $_SESSION['auth']="logged";
      $_SESSION['user']=$name;
      $_SESSION['id']=$id;
      $_SESSION['usertype']=$usertype;
      $_SESSION['lang']=$lang;
      $_SESSION['lastLogin']=$lastLogin;
      $_SESSION['pass']=md5($pass);
      $_SESSION['usertypename']=mysql_result($dbh->select('TRM_usertypes',"WHERE ID='$usertype'",'name'), 0, 'name');	
      
      $dbh->update('TRM_users',"lastLogin = NOW()","ID=$id");
      
      if(isset($_REQUEST['directgo'])){
        $directgo=$_REQUEST['directgo'];
        header("Location: $directgo");
      }
      else{
        header("Location: index.php");
      }
      exit;
    }
    else{
    	echo $dbh->getText('no login');
    }
  }
  
  if($action=="logout"){
    session_name('Bromine');
    session_start();
    $_SESSION=Array();
    if (isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time()-42000, '/');
    }
    session_destroy();
    header("Location: login.php");
    exit; 
  }
  
  if($num > 0){
    
  }
  else{
        ?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
          <head>
            <?php include('header.php'); ?>
            <link rel="stylesheet" type="text/css" href="style.css" />
          </head>
          <body>
            <div class='login'>
              <h2>Bromine login</h2>
              <br />
              <form action="" method="post">
              <table>
                <tr>
                  <td>Username</td>
                  <td><input type="text" name="name" /></td>
                </tr>
                <tr>
                  <td>Password</td>
                  <td><input type="password" name="pass" /></td>
                </tr>
                <tr>
                  <td>Language</td>
                  <td>
                    <select name='language'>
                      <?
                        $langresult = $dbh->select('TRM_langlist','','*');
                        $langnum = mysql_num_rows($langresult);
                        for ($u=0;$u<$langnum;$u++){
                          $abbrv      = mysql_result($langresult, $u, 'abbrv');
                          $full       = mysql_result($langresult, $u, 'full');
                          echo "<option value='$abbrv'>$full</option>";
                        }
                      ?>
                    </select>
                  </td>
                </tr>
              </table>
              <div><input type="submit" value="<?php echo $dbh->getText('Log in');?>" /></div>
              </form>
            </div>
            <div><img src='img/firefox_icon.png' alt='firefox icon' style='margin-top: 20px;'></div><p>This site is created for firefox.<br /> Other browsers might work.</p>
        <?php
      }
    ?>
  </body>
</html>
