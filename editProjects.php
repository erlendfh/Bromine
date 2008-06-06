<?php include('protected.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  	<?php include('header.php'); ?>
  	<link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <?php include ('menu.php') ?>
    <?php include('projectsSubMenu.php'); ?>
    <?php

      $result = $dbh->select('TRM_projects','WHERE TRM_projects.ID!=1','*');
      $num = mysql_num_rows($result);
      
      echo "<form action='saveProjects.php' method='post'>";
        echo "<table>";
          echo "<tr>";
          echo "<th align='left'>".$lh->getText('Delete')."</th>";
          echo "<th align='left'>".$lh->getText('Name')."</th>";
          echo "<th align='left'>".$lh->getText('Description')."</th>";
          echo "<th align='left'>".$lh->getText('Assigned to')."</th>";
          echo "<th align='left'>".$lh->getText('Sites to test')."</th>";
          
          echo "</tr>";
          for($i=0;$i<$num;$i++){
            $p_id         = mysql_result($result,$i,"id");
            $name         = mysql_result($result,$i,"name");
            $description  = mysql_result($result,$i,"description");
            $assigned     = mysql_result($result,$i,"assigned");
            
            echo "<tr valign='top'>";
              $confirm='"'.$lh->getText('confirmDelete').'"';
              echo "<td align='left'><a href='delete.php?type=project&amp;id=$p_id&amp;back=editProjects.php' onclick='return confirm($confirm)' ><img src='img/trashcan.gif' alt='".$lh->getText('Delete')."' /></a></td>";
              echo "
              <td align='left' id='$p_id'>
                <input type='hidden' name='p_id[]' value='$p_id' />
                <input type='text' name='name[]' value='$name' />
              </td>";
              echo "<td align='left'><textarea cols='80' rows='8' name='description[]' >$description</textarea></td>";
              echo "<td>";
              echo "<select name=assigned[]>";
              $user_result = $dbh->select('TRM_users','',"*");
              $num_users = mysql_num_rows($user_result);
              echo "<option value=''>".$lh->getText('Choose')."</option>";
              for($x = 0; $x <$num_users; $x++){
                $user_id = mysql_result($user_result, $x,'id');
                $user_name = mysql_result($user_result, $x,'name');
                if($user_id == $assigned){
                  echo "<option value='$user_id' selected='selected'>$user_name</option>";
                }
                else{
                  echo "<option value='$user_id'>$user_name</option>";
                }
              }
              echo "</select>";
              echo "</td>";
              $result2 = $dbh->select('TRM_projects_has_sites',"WHERE TRM_projects_has_sites.p_id=$p_id",'*');
              $num2 = mysql_num_rows($result2);              
              echo "<td>";
              for($u=0;$u<$num2;$u++){
                $ps_id = mysql_result($result2,$u,"id");
                $sitetotest = mysql_result($result2,$u,"sitetotest");
                echo "<input type='text' name='sitetotest[$ps_id]' value='$sitetotest' size='30'/>";
                echo "<a href='delete.php?type=projects_has_sites&amp;id=$ps_id&amp;back=editProjects.php' onclick='return confirm($confirm)' ><img src='img/trashcan.gif' alt='".$lh->getText('Delete')."' /></a><br />";
              }
              echo $lh->getText('Add new');
              echo "<br />";
              echo "<input type='text' name='sitetotestnew[$p_id]' size='30' />";
              echo "</td>";
            echo "</tr>";
          }
        echo "</table>";
    
    ?>
      
      <p><?php echo $lh->getText('Add project') ?></p>
      <div>
        <?php
            echo "<table>";
              echo "<tr>";
              echo "<th align='left'>".$lh->getText('Name')."</th>";
              echo "<th align='left'>".$lh->getText('Description')."</th>";
              echo "<th align='left'>".$lh->getText('Assigned to')."</th>";
              echo "</tr>";
              echo "<tr valign='top'>";
                echo "
                <td align='left'>
                  <input type='hidden' name='newp_id' />
                  <input type='text' name='newname' />
                </td>";
                echo "<td align='left'><textarea cols='80' rows='8' name='newdescription'></textarea></td>";
              echo "<td >";
              echo "<select name='newassigned'>";
              echo "<option value=''>".$lh->getText('Choose')."</option>";
              for($x = 0; $x <$num_users; $x++){
                $user_id = mysql_result($user_result, $x,'id');
                $user_name = mysql_result($user_result, $x,'name');
                echo "<option value='$user_id'>$user_name</option>";
              }
              echo "</select>";
              echo "</td>";
                
              echo "</tr>";
            echo "</table>";
        ?>
      </div>
      <div><input type='submit' value='<?php echo $lh->getText('Submit'); ?>' /></div>
    </form>
  </body>
</html>
