<?php include('protected.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  	<?php include('header.php'); ?>
  	<link rel="stylesheet" type="text/css" href="style.css" />
  	<script type='text/javascript'>
  	<!--
  	function delfunction(i){
      document.getElementById("task"+i).value='';
      document.getElementById("new_task").value='';
      document.forms['cronForm'].submit();
    }
    -->
  	</script>
  </head>
  <body>
    <?php include ('menu.php') ?>
    <?php include('testlabSubMenu.php'); ?>
    <form action='saveCron.php' method='post' id='cronForm'>
      <table width='1000'>
        <tr>
          <th><?php echo $lh->getText('Disabled'); ?></th>
          <th><?php echo $lh->getText('Minute'); ?></th>
          <th><?php echo $lh->getText('Hour'); ?></th>
          <th><?php echo $lh->getText('Day'); ?></th>
          <th><?php echo $lh->getText('Month'); ?></th>
          <th><?php echo $lh->getText('Weekday'); ?></th>
          <th><?php echo $lh->getText('Task'); ?></th>
          <th><?php echo $lh->getText('Delete'); ?></th>
        </tr>
        <?php
          $months=array('','January','February','March','April','May','June','July','August','September','October','November','December');
          $weekdays=array('','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
          
          function get_crontab(){
            return shell_exec('crontab -l');
          }
          
          $cron=get_crontab();
          $cronjobs=explode("\n",$cron);
          $num_cronjobs=count($cronjobs); 
          for($i=0;$i<count($cronjobs) && strlen($cronjobs[$i])>0;$i++){
            $parts=explode(" ",$cronjobs[$i],6);
            $checked="";
            if ($parts[0][0] == "#"){
              $checked="checked='checked'";
              $parts[0] = str_replace("#","",$parts[0]);
            }
            $min=$parts[0];
            //echo ">>$min<<";
            $hour=$parts[1];
            $day_of_month=$parts[2];
            $month=$parts[3];
            $day_of_week=$parts[4];
            $task=str_replace('&','&amp;',$parts[5]);
            echo "<tr>";
            echo "<td>";
            echo "<input type='checkbox' name='disabled[$i]' value='#' $checked />";
            echo "</td>";
            echo "<td>";
            
            echo "<select name='minutes[]'>";
            echo "<option value='*' ";
            if($min=='*'){echo "selected='selected'";}
            echo ">".$lh->getText('All minutes')."</option>";
            for($x=0;$x<=59;$x++){
              echo "<option value='$x'";
              if("$x"=="$min"){
                echo " selected='selected'";
              }
              echo ">$x</option>";
            }
            echo "</select>";
            
            echo "</td>";
            echo "<td>";
            
            echo "<select name='hours[]'>";
            echo "<option value='*' ";
            if($hour=='*'){echo "selected='selected'";}
            echo ">".$lh->getText('All hours')."</option>";
            for($x=0;$x<=23;$x++){
              echo "<option value='$x'";
              if("$x"=="$hour"){
                echo " selected='selected'";
              }
              echo ">$x</option>";
            }
            echo "</select>";
            
            echo "</td>";
            echo "<td>";
            
            echo "<select name='days[]'>";
            echo "<option value='*'>".$lh->getText('All days')."</option>";
            for($x=1;$x<=31;$x++){
              echo "<option value='$x'";
              if($x==$day_of_month){
                echo " selected='selected'";
              }
              echo ">$x</option>";
            }
            echo "</select>";
            
            echo "</td>";
            echo "<td>";
            
            echo "<select name='months[]'>";
            echo "<option value='*'>".$lh->getText('All months')."</option>";
            for($x=1;$x<=12;$x++){
              echo "<option value='$x'";
              if($x==$month){
                echo " selected='selected'";
              }
              echo ">$months[$x]</option>";
            }
            echo "</select>";
            
            echo "</td>";
            echo "<td>";
            
            echo "<select name='weekdays[]'>";
            echo "<option value='*'>".$lh->getText('All weekdays')."</option>";
            for($x=1;$x<=7;$x++){
              echo "<option value='$x'";
              if($x==$day_of_week){
                echo " selected='selected'";
              }
              echo ">$weekdays[$x]</option>";
            }
            echo "</select>";
            
            echo "</td>";
            echo "<td>";
            
            echo "<input type='text' size='75' name='tasks[]' id='task$i' value='$task' />";
            
            echo "</td>";
            echo "<td>";
            $confirm='"'.$lh->getText('confirmDelete').'"';
              echo "<a href='javascript:delfunction($i)' onclick='return confirm($confirm)' ><img src='img/trashcan.gif' alt='".$lh->getText('Delete')."' /></a>";
            echo "</td>";
            echo "</tr>";
          }
        
        ?>

        <tr>
          <td colspan='5'><?php echo $lh->GetText('Add scheduled test') ?></td>
        </tr>
        <tr>
          <?php
          echo "<td></td>";
          echo "<td>";
            
            echo "<select name='minutes[]'>";
            echo "<option value='*'>".$lh->getText('All minutes')."</option>";
            for($x=0;$x<=59;$x++){
              echo "<option value='$x'>$x</option>";
            }
            echo "</select>";
            
            echo "</td>";
            echo "<td>";
            
            echo "<select name='hours[]'>";
            echo "<option value='*'>".$lh->getText('All hours')."</option>";
            for($x=0;$x<=23;$x++){
              echo "<option value='$x'>$x</option>";
            }
            echo "</select>";
            
            echo "</td>";
            echo "<td>";
            
            echo "<select name='days[]'>";
            echo "<option value='*'>".$lh->getText('All days')."</option>";
            for($x=1;$x<=31;$x++){
              echo "<option value='$x'>$x</option>";
            }
            echo "</select>";
            
            echo "</td>";
            echo "<td>";
            
            echo "<select name='months[]'>";
            echo "<option value='*'>".$lh->getText('All months')."</option>";
            for($x=1;$x<=12;$x++){
              echo "<option value='$x'>$months[$x]</option>";
            }
            echo "</select>";
            
            echo "</td>";
            echo "<td>";
            
            echo "<select name='weekdays[]'>";
            echo "<option value='*'>".$lh->getText('All weekdays')."</option>";
            for($x=1;$x<=7;$x++){
              echo "<option value='$x'>$weekdays[$x]</option>";
            }
            echo "</select>";
            
            echo "</td>";
            echo "<td>";
/*            $finalresult=$_GET['finalresult'];
            $type=$_GET['type'];
            if(strlen($type)>0 && strlen($finalresult)>0){ 
              if($type=='node'){
                $url="http://".$_SERVER['SERVER_NAME'];
                $value="firefox $url/testRunnerRC.php?url=$finalresult";
              }
              if($type=='core'){
                $value="firefox $url/testRunnerRC.php?url=$finalresult";
              }
            }
 */
          if ($_GET['newurl']){
                      $url=str_replace("--!!--", "&", $_GET['newurl']);
                      $value="DISPLAY=:0 firefox &#39;$url&#39;";
                      } 
           echo "<input id='new_task' type='text' size='75' name='tasks[]' value='$value' />";

            
            echo "</td>";
            echo "<td>";
            
            echo "</td>";
            echo "</tr>";
          
          ?>
      </table>
      <div><input type='submit' value='<?php echo $lh->getText('Submit'); ?>' /></div>
    </form>
    <!--pre><?php echo $cron; ?></pre-->
  </body>
</html>
