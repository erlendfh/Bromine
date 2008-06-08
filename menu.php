<?php 
  //$basecolors=Array('DodgerBlue','SandyBrown','LightSteelBlue','SeaGreen','#FF9900','#66CC00','FireBrick','DarkSlateGray');
  $basecolors=Array('rgb(30,144,255)','rgb(176,196,222)','#FF9900','#66CC00','#999999');
?>
<table class='menu'>
  <tr>
    <td colspan="4">
      <form method='get' action='' id='p_id_form' style='display: inline;'>
        <?php
          $get=$_GET['get'];
          if($get!='' && $get!='nogo'){
            $get=explode(',',$get);
            $_SESSION['p_id']=$get[0];
            $_SESSION['p_name']=$get[1];
            
            $_SESSION["suitename"]=$lh->getText('All');
            $_SESSION["environment"]=$lh->getText('All');
            $_SESSION["platform"]=$lh->getText('All');
            $_SESSION["browser"]=$lh->getText('All');
            $_SESSION["timeDate1"]=$lh->getText('yyyy-mm-dd');
            $_SESSION["timeDate2"]=$lh->getText('yyyy-mm-dd');
          }
          $dbh = new DBHandler();
          $barcolor=$_SESSION['barcolor'];
          if($sitename=='editHR.php' || $sitename=='projectsindex.php' || $sitename=='editProjects.php'){
            $result=$dbh->select('TRM_projects',"ORDER BY name","*");
          }
          else{
            $result=$dbh->select('TRM_projects, TRM_projectList',"WHERE TRM_projectList.userId = '".$_SESSION['id']."' AND TRM_projectList.access='1' AND TRM_projectList.projectID=TRM_projects.ID ORDER BY TRM_projects.name","TRM_projects.*");
          }
          $notset=1;
          $numreports=mysql_numrows($result);
          echo "<div id='blink' style='display: inline; color: black; cursor: default;'>".$lh->getText('Choose project').":</div> ";
          echo "<div style='display: inline; color: black; cursor: default;'>";
          echo "<select name='get' onchange='document.forms[".'"'."p_id_form".'"'."].submit()'>";
          echo "<option value='nogo'>".$lh->getText('Choose project')."</option>";
          for($i=0;$i<$numreports;$i++){
            $p_id=mysql_result($result,$i,"id");
            $p_name=mysql_result($result,$i,"name");
            echo "<option value='$p_id,$p_name'";
    
            if($_SESSION['p_id']==$p_id){echo ' selected="selected"'; $notset=0;}
            
            echo ">$p_name</option>";
          }
          echo "</select>";
          echo "</div>";
          if($notset){
            $_SESSION['p_id']='';
            $_SESSION['p_name']='';
            ?>
            <script type="text/javascript">
              function blink(id){
               elmvis=document.getElementById(id).style.visibility;
                if(elmvis=='hidden'){
                  document.getElementById(id).style.visibility='visible';
                }else{
                  document.getElementById(id).style.visibility='hidden'
                }
               setTimeout("blink('"+id+"')",400);
              }
              blink('blink');
              </script>
            <?php 
          }
          
        ?>
      </form>
    </td>
    <td align='right'>
      <?php
        if($_SESSION['auth']=="logged"){echo "<button onclick='window.location=".'"'."login.php?action=logout".'"'."' style='background-color: rgb(139,0,0); color: white;'>".$lh->getText('log out')."</button>";}
      ?>
    </td>
  </tr>
  <tr>
    <td> 
      <div style='background-color: <?php echo $basecolors[0]; ?>;'>
        <a class='full' href='index.php' name='menulink'>
          <?php echo $lh->getText('Home'); ?>
        </a>
      </div>
    </td>
    <td>
      <div style='background-color: <?php echo $basecolors[1]; ?>; ;'>
        <a class='full' href='projectsindex.php' name='menulink'>
          <?php echo $lh->getText('Projects'); ?>
        </a>
        
      </div>
    </td>
    <td>
      <div style='background-color: <?php echo $basecolors[2]; ?>;'>
        <a class='full' href='testlabindex.php' name='menulink'>
          <?php echo $lh->getText('Test Lab'); ?>
        </a>
      </div>
    </td>
    <td>  
      <div style='background-color: <?php echo $basecolors[3]; ?>;'>
        <a class='full' href='TRMindex.php' name='menulink'>
        <?php echo $lh->getText('Test Result Manager'); ?>
        </a>
      </div>
    </td>
    <td>
      <div style='background-color: <?php echo $basecolors[4]; ?>;'>
        <a class='full' href='adminindex.php' name='menulink'>
          <?php echo $lh->getText('Link to admin-site'); ?>
        </a>
      </div>
    </td>
  </tr>
</table>
