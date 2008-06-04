<?php include ('protected.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include('header.php'); ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <?php $prepath=''; include ('menu.php') ?>
    <?php $prepath=''; include('projectsSubMenu.php'); ?>
    <?php
    
    $p_id=$_SESSION['p_id'];
    ?>
    
    <?php if($p_id!=''){ ?>
      <form action='saveHR.php' method='post'>
        <div><?php echo "<input type='hidden' name='p_id' value='$p_id' />"; ?></div>
        <table width='400'>
          <tr>
            <th align='left'><?php echo $lh->GetText('Access'); ?></th>
            <th align='left'><?php echo $lh->GetText('Username'); ?></th>
            <th align='left'><?php echo $lh->GetText('Name'); ?></th>
            <th align='left'><?php echo $lh->GetText('Usertype'); ?></th>
          </tr>
          
          <?php
            $result = $dbh->select('TRM_users, TRM_usertypes, TRM_projectList',
            "WHERE TRM_users.usertype=TRM_usertypes.ID AND
            TRM_users.ID=TRM_projectList.userID AND
            TRM_projectList.projectID='$p_id'
            ORDER BY TRM_users.usertype, TRM_users.name",'*');
            $num=mysql_numrows($result);
            for($i=0;$i<$num;$i++){
              $u_id=mysql_result($result,$i,"TRM_users.ID");
              $username=mysql_result($result,$i,"TRM_users.name");
              $firstname=mysql_result($result,$i,"firstname");
              $lastname=mysql_result($result,$i,"lastname");
              $access=mysql_result($result,$i,"access");
              $name="$firstname $lastname";
              $usertype=mysql_result($result,$i,"TRM_usertypes.name");
              echo "<tr>";
              echo "<td><input type='checkbox' name='u_id[]' value='$u_id' ";
              if($access==1){
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
    <?php } ?>
  </body>
</html>
