<?php include ('protected.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include ('header.php'); ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <?php 
require 'menu.php';
BromineSubmenu::renderProjectsSubmenu();
    
$p_id = $_SESSION['p_id'];
?>
    
    <?php if ($p_id != '') { ?>
      <form action='saveHR.php' method='post'>
        <div><?php echo "<input type='hidden' name='p_id' value='$p_id' />"; ?></div>
        <table width='400'>
          <tr>
            <th align='left'><?php echo $lh->getText('Access'); ?></th>
            <th align='left'><?php echo $lh->getText('Username'); ?></th>
            <th align='left'><?php echo $lh->getText('Name'); ?></th>
            <th align='left'><?php echo $lh->getText('Usertype'); ?></th>
          </tr>
          
          <?php
    $result = $dbh->select('trm_users, trm_usertypes, trm_projectlist', "WHERE trm_users.usertype=trm_usertypes.ID AND
            trm_users.ID=trm_projectlist.userID AND
            trm_projectlist.projectID='$p_id'
            ORDER BY trm_users.usertype, trm_users.name", '*');
    $num = mysql_numrows($result);
    for ($i = 0;$i < $num;$i++) {
        $u_id = mysql_result($result, $i, "trm_users.ID");
        $username = mysql_result($result, $i, "trm_users.name");
        $firstname = mysql_result($result, $i, "firstname");
        $lastname = mysql_result($result, $i, "lastname");
        $access = mysql_result($result, $i, "access");
        $name = "$firstname $lastname";
        $usertype = mysql_result($result, $i, "trm_usertypes.name");
        echo "<tr>";
        echo "<td><input type='checkbox' name='u_id[]' value='$u_id' ";
        if ($access == 1) {
            echo " checked='checked'";
        }
        echo " /></td>";
        echo "<td>$username</td>";
        echo "<td>$name</td>";
        echo "<td>$usertype</td>";
        echo "</tr>";
    }
?>
          
        </table>
        <div><input type='submit' value='<?php echo $lh->getText('Submit'); ?>' /></div>
      </form>      
    <?php
} ?>
  </body>
</html>