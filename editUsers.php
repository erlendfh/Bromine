<?php include ('protected.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include('header.php'); ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <?php include ('menu.php') ?>
    <?php include('adminSubMenu.php'); ?>
    <form action='saveUsers.php' method='post'>
      <table>
        <tr valign='top'>
          <th align='left'> <?php echo $lh->getText('Username') ?> </th>
          <th align='left'> <?php echo $lh->getText('First name') ?> </th>
          <th align='left'> <?php echo $lh->getText('Last name') ?> </th>
          <th align='left'> <?php echo $lh->getText('Password') ?> </th>
          <th align='left'> <?php echo $lh->getText('Usertype') ?> </th>
          <th align='left'> <?php echo $lh->getText('Email') ?> </th>
          <th align='left'> <?php echo $lh->getText('Delete') ?> </th>
        </tr>
        <?php
          $dbh = new DBHandler();
          
          $usertypelistresult=$dbh->select('TRM_usertypes',"WHERE ID!=7","DISTINCT name, ID");
          $usertypenum=mysql_numrows($usertypelistresult);
          
          $confirm='"'.$lh->getText('confirmDelete').'"';
          
          $result=$dbh->select('TRM_users',"WHERE ID!=1 ORDER BY usertype, name","*");
          
          $num=mysql_numrows($result);
          for($i=0;$i<$num;$i++){
            $u_id=mysql_result($result,$i,"ID");
            $name=mysql_result($result,$i,"TRM_users.name");
            $firstname=mysql_result($result,$i,"firstname");
            $lastname=mysql_result($result,$i,"lastname");
            $password=mysql_result($result,$i,"password");
            $usertype=mysql_result($result,$i,"usertype");
            $email=mysql_result($result,$i,"email");
            echo "<tr>";
            echo "<td id='$u_id'>" . ($i+1) . ":<input type='hidden' name='u_id[]' value='$u_id' />
                      <input type='text' name='name[]' value='$name' /></td>";
            echo "<td><input type='text' name='firstname[]' value='$firstname' /></td>";
            echo "<td><input type='text' name='lastname[]' value='$lastname' /></td>";
            echo "<td><input type='text' name='password[]' value='$password' /></td>";
            echo "<td>";
              echo "<select name='ut_id[]'>";
              for($u=0;$u<$usertypenum;$u++){
                $ut_id=mysql_result($usertypelistresult,$u,"ID");
                $utname=mysql_result($usertypelistresult,$u,"name");
                echo "<option value='$ut_id'";
                if($ut_id==$usertype){echo " selected='selected'";}
                echo ">$utname</option>";
              }
              echo "</select>";
            echo "</td>";
            echo "<td><input type='text' name='email[]' value='$email' /></td>";
            echo "<td><a href='delete.php?type=user&amp;id=$u_id"."&amp;back=editUsers.php' onclick='return confirm($confirm)' ><img src='img/trashcan.gif' alt='".$dbh->getText('Delete')."'/></a></td>";
            echo "</tr>";
          }
        ?>
        <tr>
          <td colspan='7'> <?php echo $lh->getText('Add user') ?> </td>
        </tr>
        <tr>
          <td><input type='text' name='newname' /></td>
          <td><input type='text' name='newfirstname' /></td>
          <td><input type='text' name='newlastname' /></td>
          <td><input type='text' name='newpassword' /></td>
          <td>
            <select name='newut_id'>
              <?php 
                for($u=0;$u<$usertypenum;$u++){
                  $ut_id=mysql_result($usertypelistresult,$u,"ID");
                  $utname=mysql_result($usertypelistresult,$u,"name");
                  echo "<option value='$ut_id'>$utname</option>";
                }
              ?>
            </select>
          </td>
          <td><input type='text' name='newemail' /></td>
        </tr>
      </table>
      <div><input type='submit' value='<?php echo $lh->getText('Submit'); ?>' /></div>
    </form>
    <?php if(isset($_GET["c_user"])){
            echo '<br /><div style="color:red;"><p>'.$lh->getText('Username').' "'.$_GET['c_user'].'" '.$lh->getText('Already exist').'!</p></div>';
          }
          if(isset($_GET["usrPwd"])){
                        echo '<br /><div style="color:red;"><p>'.$_GET["usrPwd"].'!</p></div>';
          }
          
    ?>
  </body>
</html>
