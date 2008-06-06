<?php include ('protected.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include('header.php'); ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <?php include('menu.php') ?>
    <?php 
      include('projectsSubMenu.php');
     ?>
    
    <form action='saveRequirements.php' method='post'>
      <table border='0'>
        <tr>
          <th align="left"><?php echo $lh->getText('Nr'); ?></th>
      		<th align="left"><?php echo $lh->getText('Requirement'); ?></th>
      		<th align="left"><?php echo $lh->getText('Description'); ?></th>
      		<th align="left"><?php echo $lh->getText('OS/Browser requirements'); ?></th>
      		<th align="left"><?php echo $lh->getText('Author'); ?></th>
      		<th align="left"><?php echo $lh->getText('Priority'); ?></th>
      		<th align="left"><?php echo $lh->getText('Assigned to'); ?></th>
      		<th align="left"><?php echo $lh->getText('Delete'); ?></th>
        </tr>
        <?php
          $p_id = $_SESSION['p_id'];
          $u_id = $_SESSION['id'];
          $user = $_SESSION['user'];
          $confirm='"'.$lh->getText('confirmDelete').'"';
          $OSresult = $dbh->select('TRM_OS','','*');
          $OS = Array();
          $OSID = Array();
          while($row = mysql_fetch_array($OSresult)){
          	array_push($OS,$row['OSname']);     
           	array_push($OSID,$row['ID']);
          	
          }
          $browserresult = $dbh->select('TRM_browser','','*');
          $Browser = Array();
          $BrowserID = Array();
          while($row = mysql_fetch_array($browserresult)){
          	array_push($Browser,$row['browsername']);
          	array_push($BrowserID,$row['ID']);
          }

        
          $result = $dbh->select("TRM_requirements, TRM_projectList", "WHERE TRM_requirements.p_id = '$p_id' AND TRM_projectList.projectID=TRM_requirements.p_id AND TRM_projectList.userID='$u_id' AND TRM_projectList.access='1' ORDER BY TRM_requirements.priority", "TRM_requirements.*");
          $num_row=mysql_numrows($result);
          if ($num_row > 0){
          	for ($a=0;$a<$num_row;$a++){
              $r_id = mysql_result($result,$a,"TRM_requirements.id");
              $name = mysql_result($result,$a,"name");
              $nr = mysql_result($result,$a,"nr");
              $author = mysql_result($result,$a,"author");
              $description = mysql_result($result,$a,"description");
              $priority = mysql_result($result,$a,"priority");
              $assigned = mysql_result($result,$a,"assigned");
              echo "<tr valign='top'>";
              echo "<td id='$nr'><input type='hidden' value='$r_id' size='0' name='id[]' />";
              echo "<input type='text' value='$nr' size='2' name='nr[]' /></td>";
        	    echo "<td><input type='text' value='$name' size='16' name='name[]' /></td>";
              echo "<td><textarea rows='8' cols='90' name='description[]' >$description</textarea></td>";
              echo "<td>";            
              $rresult = $dbh->select("TRM_ReqsOSBrows, TRM_OS, TRM_browser",
              "WHERE TRM_ReqsOSBrows.r_id = '$r_id' AND 
              TRM_OS.ID = TRM_ReqsOSBrows.o_id AND
              TRM_browser.ID = TRM_ReqsOSBrows.b_id", "*");
              $rnum_row=mysql_numrows($rresult);
              for ($b=0;$b<$rnum_row;$b++){
                $OScur = mysql_result($rresult,$b,"OSname");
                $Browsercur = mysql_result($rresult,$b,"browsername");
                $ID = mysql_result($rresult,$b,"ID");
                
                echo "<input type='hidden' value='$ID' name='ReqsOSBrows[]'/>";
                
                echo "<select name='OS[$r_id][]'>";
                  for($c=0;$c<count($OS);$c++){
                    echo "<option value='$OSID[$c]'";
                    if($OScur==$OS[$c]){echo " selected='selected'" ;}
                    echo ">$OS[$c]</option>";
                  }
                echo "</select>";
      
                echo "<select name='browser[$r_id][]'>";
                  for($c=0;$c<count($Browser);$c++){
                    echo "<option value='$BrowserID[$c]'";
                    if($Browsercur==$Browser[$c]){echo " selected='selected'" ;}
                    echo ">$Browser[$c]</option>";
                  }
                echo "</select>";
                echo "<a href='delete.php?type=OSBrows&amp;id=$ID&amp;back=editRequirements.php' onclick='return confirm($confirm)' ><img src='img/trashcan.gif' alt='".$lh->getText('Delete')."' /></a>";
                echo "<br />";
                
              }
              echo $lh->getText('Add new')."<br />";
              echo "<select name='OSnew[$r_id]'>";
              echo "<option value=''>".$lh->getText('Choose')."</option>";
                  for($c=0;$c<count($OS);$c++){
                    echo "<option value='$OSID[$c]'";
                    echo ">$OS[$c]</option>";
                  }
                echo "</select>";
      
                echo "<select name='browsernew[$r_id]'>";
                echo "<option value=''>".$lh->getText('Choose')."</option>";
                  for($c=0;$c<count($Browser);$c++){
                    echo "<option value='$BrowserID[$c]'";
                    echo ">$Browser[$c]</option>";
                  }
                echo "</select>";
                
                
              echo "</td>";
              echo "<td>$author</td>";       
              
              $priority2 = str_replace(" ", "_", $priority);
              $prioname = array('Urgent','Very high','High','Medium','Low');
              $prio = array($lh->getText('Urgent'), $lh->getText('Very high'), $lh->getText('High'), $lh->getText('Medium'),$lh->getText('Low'));
              //<img src='/img/priority$priority2.gif' title='".$lh->getText($priority)."'/>
              echo "
              <td>
                <select name='changePriority[]'>";
                for ($i = 0; $i < count($prio); $i++){
                  echo "<option value='$prioname[$i]'";
                  if ($priority == $prioname[$i]) {echo " selected='selected'";}
                  echo ">$prio[$i]</option>";
                }
                  

              echo  "</select>
              </td><td>";
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
              
              echo "<td align='left'><a href='delete.php?type=requirement&amp;id=$r_id&amp;back=editRequirements.php' onclick='return confirm($confirm)' ><img src='img/trashcan.gif' alt='".$lh->getText('Delete')."' /></a></td>";
        	  	echo "</tr>";
          	}
          }
          
        ?>
        <tr valign='top'>
          
          <td>
            <input type='text' size='2' name='newnr2'/>
            <input type='hidden' size='0' name='p_id' value='<?php echo $p_id; ?>'/>
            <input type='hidden' size='0' name='author' value='<?php echo $user; ?>'/>
          </td>
          <td><input type='text' size='16' name='newname2' /></td>
          <td><textarea rows='8' cols='90' name='newdescription2' ></textarea></td>
      		<td>
            <?php
              
              echo "<select name='OSnew2'>";
              for($c=0;$c<count($OS);$c++){
                echo "<option value='$OSID[$c]'";
                echo ">$OS[$c]</option>";
              }
              echo "</select>";
              echo "<select name='browsernew2'>";
              for($c=0;$c<count($Browser);$c++){
                echo "<option value='$BrowserID[$c]'";
                echo ">$Browser[$c]</option>";
              }
              echo "</select>";
            ?>
          </td>
          <td>
            <?php echo $user; ?> 
          </td>
          <td>
            <select name='priority2'>
              <option value='Urgent'><?php echo $lh->getText('Urgent'); ?></option>
              <option value='Very high'><?php echo $lh->getText('Very high'); ?></option>
              <option value='High'><?php echo $lh->getText('High'); ?></option>
              <option value='Medium'><?php echo $lh->getText('Medium'); ?></option>
              <option value='Low'><?php echo $lh->getText('Low'); ?></option>
            </select>
          </td>
          <td><?php
              echo "<select name=newassigned>";
              $user_result = $dbh->select('TRM_users','',"*");
              $num_users = mysql_num_rows($user_result);
              echo "<option value=''>".$lh->getText('Choose')."</option>";
              for($x = 0; $x <$num_users; $x++){
                $user_id = mysql_result($user_result, $x,'id');
                $user_name = mysql_result($user_result, $x,'name');
                echo "<option value='$user_id'>$user_name</option>";
              }
              echo "</select>";
              echo "</td>";
              ?>
        </tr>
      </table>
      <div><input type='submit' value='<?php echo $lh->getText('Submit'); ?>' /></div>
    </form>
  </body>
</html>
