<?php include ('protected.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include('header.php'); ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <?php
    $confirm='"'.$lh->getText('confirmDelete').'"';
    $d_id = $_GET['d_id'];
    $t_id = $_GET['t_id'];
    $p_id = $_SESSION['p_id'];
    $p_name=$_SESSION['p_name'];
    $is_empty = 'true';
    $typeresult = $dbh->select('TRM_type_of_defects',"",'*');
    while($row = mysql_fetch_array($typeresult)){
    	$type_id_arr[]=$row['id'];
    	$type_short_arr[]=$row['name'];
    	$type_imgpaths[]=$row['imgpath'];
    }
    
    $statusresult = $dbh->select('TRM_type_of_defect_status',"",'*');
    while($row = mysql_fetch_array($statusresult)){
      $status_id_arr[]=$row['id'];
    	$status_short_arr[]=$row['name'];
    	$status_imgpaths[]=$row['imgpath'];
    }
    
    $sttresult = $dbh->select('TRM_projects_has_sites',"WHERE p_id=$p_id",'*');
    while($row2 = mysql_fetch_array($sttresult)){
    	$stt[]=$row2['sitetotest'];
    	$stt_id2[]=$row2['ID'];
    }


    
    if($d_id!=''){
    
      $attachmentresult = $dbh->select('TRM_defect_has_attachment',"WHERE d_id='$d_id'",'*');
      while($row = mysql_fetch_array($attachmentresult)){
      	$attachment_path[]=$row['attachment_path'];
      	$microtime[]=$row['microtime'];
      	$attachment_id[]=$row['id'];
      }
    
      $defectresult = $dbh->select('TRM_defects, TRM_projects, TRM_type_of_defects, TRM_type_of_defect_status, TRM_projects_has_sites',
      "WHERE 
      TRM_defects.ID=$d_id AND
      TRM_projects.ID=TRM_defects.p_id AND
      TRM_type_of_defects.ID=TRM_defects.type_of_defect AND
      TRM_type_of_defect_status.ID=TRM_defects.status
      "
      ,
      'TRM_defects.id as id,
       TRM_defects.description as description,
       TRM_defects.priority as priority,
       TRM_defects.createdby as createdby,
       TRM_defects.updatedby as updatedby,
       TRM_defects.created as created,
       TRM_defects.updated as updated,
       TRM_defects.name as d_name,
       TRM_defects.type_of_defect as type_id,
       TRM_defects.status as status_id,
       TRM_defects.t_id as t_id,
       TRM_defects.stt_id as stt_id,
       TRM_projects.name as p_name,
       TRM_type_of_defects.name as type_short,
       TRM_type_of_defects.imgpath as type_imgpath,
       TRM_type_of_defect_status.imgpath as status_imgpath,
       TRM_type_of_defect_status.name as status_short
        ');
        
      while($row = mysql_fetch_array($defectresult)){
        $is_empty = 'false';
        $id=$row['id'];
        $d_name=$row['d_name'];
      	$description=$row['description'];
      	$type_id=$row['type_id'];
      	$status_id=$row['status_id'];
      	$type_short=$row['type_short'];
      	$type_imgpath=$row['type_imgpath'];
      	$status_imgpath=$row['status_imgpath'];
      	$status_short=$row['status_short'];
      	$created=$row['created'];
      	$updated=$row['updated'];
      	$p_name=$row['p_name'];
      	$t_id=$row['t_id'];
      	$createdby_id=$row['createdby'];
      	$updatedby_id=$row['updatedby'];
      	$priority=$row['priority'];
      	$stt_id=$row['stt_id'];
      	
      	$updatedbyresult = $dbh->select('TRM_users',"WHERE ID=$updatedby_id",'*');
        while($row2 = mysql_fetch_array($updatedbyresult)){
        	$updatedby=$row2['name'];
        }
      	$createdbyresult = $dbh->select('TRM_users',"WHERE ID=$createdby_id",'*');
        while($row2 = mysql_fetch_array($createdbyresult)){
        	$createdby=$row2['name'];
        }
        
        if ($stt_id != ''){
          $sttresult = $dbh->select('TRM_projects_has_sites',"WHERE ID=$stt_id",'*');
          while($row2 = mysql_fetch_array($sttresult)){
          	$currentstt=$row2['sitetotest'];
          }
        }
        
        if($t_id!=''){
            $t_id_result = $dbh->select('TRM_test',"WHERE ID=$t_id",'*');
            $showerror=true;
            while($row3 = mysql_fetch_array($t_id_result)){
                $showerror=false;
            }
        }
        
      }

    }
    
  	echo "<form action='saveDefect.php' method='POST' enctype='multipart/form-data'>";
  	echo "<input type='hidden' name='d_id' value='$d_id' />";
  	echo "<table>";
  	echo "<tr>";
  	echo "<td>".$lh->getText('Project')."</td><td>$p_name</td>";
  	echo "</tr>";
  	if($t_id!=''){
        if($showerror){
            echo "<td>".$lh->getText('Test')."</td><td>".$lh->getText('Test results deleted')."</td></tr>";
        }else{
            $s_id = mysql_result($dbh->sql("SELECT s_id FROM TRM_test WHERE id=$t_id"),0);
            echo "<tr>";
            echo "<td>".$lh->getText('Test')."</td><td><input type='hidden' value='$t_id' name='t_id'/><a href='showReport.php?id=$s_id&highlight=$t_id' target='_blank'>$t_id</a></td>";
            echo "</tr>";
    	}
  	}
  	echo "<tr>";
  	echo "<td>".$lh->getText('Defect').":</td><td><input type='text' name='name' value='$d_name' size='60'/></td>";
  	echo "</tr>";
  	echo "<tr>";
  	echo "<td>".$lh->getText('Type').":</td><td><img src='$type_imgpath' id='type' ". ($type_imgpath ? "style='display: inline;'" : "style='display: none;'"). " />";
  	echo "<select name='type' id='typeselect' onchange=".'"'."gah=document.getElementById('typeselect'); img=gah.options[gah.selectedIndex].id; document.getElementById('type').src=img; document.getElementById('type').style.display='inline'".'"'.">";
    echo "<option value=''>".$lh->getText('Choose')."</option>";
    foreach($type_id_arr as $key => $value){
      echo "<option value='$value' id='$type_imgpaths[$key]' ";
      if($value==$type_id){echo "selected='selected'";}
      echo ">".$lh->getText("$type_short_arr[$key]")."</option>";
    }
    echo "</select>";

  	echo "</tr>";
  	
    echo "<tr><td>".$lh->getText('Environment')."</td>";
    echo "<td><select name='stt'>";
      echo "<option value='0'>".$lh->getText('Choose')."</option>";
      foreach($stt as $key => $value){
        echo "<option value='$stt_id2[$key]' ";
        if($value==$currentstt){echo "selected='selected'";}
        echo ">$stt[$key]</option>";
      }
    echo "</select>";
    
    echo "</td></tr>"; 
  	
  	echo "<tr>";
  	echo "<td>".$lh->getText('Status').":</td><td><img src='$status_imgpath' id='status' ". ($status_imgpath ? "style='display: inline;'" : "style='display: none;'"). " />";
    echo "<select name='status' id='statusselect' onchange=".'"'."gah=document.getElementById('statusselect'); img=gah.options[gah.selectedIndex].id; document.getElementById('status').src=img;  document.getElementById('type').style.display='inline'".'"'.">";

    if ($is_empty == 'false'){
        echo "<option value=''>".$lh->getText('Choose')."</option>";  
        foreach($status_id_arr as $key => $value){
        echo "<option value='$value' id='$status_imgpaths[$key]' ";
        if($value==$status_id){echo "selected='selected'";}
        echo ">".$lh->getText("$status_short_arr[$key]")."</option>";
      }
    }
    else{
      echo "<option value='1'>Open</option>"; 
    }
    
    echo "</select>";
  	echo "</tr>";
  	?>
  	<tr>
    	<td>
        <?php echo $lh->getText('Priority'); ?>
    	</td>
    	<td>
      	<select name='priority'>
          <option value='Urgent' <?php if($priority=='Urgent'){echo "selected='selected'";} ?>><?php echo $lh->getText('Urgent'); ?></option>
          <option value='Very high' <?php if($priority=='Very high'){echo "selected='selected'";} ?>><?php echo $lh->getText('Very high'); ?></option>
          <option value='High' <?php if($priority=='High'){echo "selected='selected'";} ?>><?php echo $lh->getText('High'); ?></option>
          <option value='Medium' <?php if($priority=='Medium'){echo "selected='selected'";} ?>><?php echo $lh->getText('Medium'); ?></option>
          <option value='Low' <?php if($priority=='Low'){echo "selected='selected'";} ?>><?php echo $lh->getText('Low'); ?></option>
        </select>
      </td>
    </tr>
    <?php
    echo "<tr>";
    echo "<td>".$lh->getText('Created by').":</td><td>$createdby @ $created</td>";
    echo "</tr>";
    echo "<tr>";
  	echo "<td>".$lh->getText('Updated by').":</td><td>$updatedby @ $updated</td>";
  	echo "</tr>";

    	for ($i = 0; $i<count($attachment_path);$i++){
        echo "<tr>";  
        $the_path = str_replace('_'.$microtime[$i],'', $attachment_path[$i]);
        echo "<td>".$lh->getText('Attachment').":</td><td>$the_path<a href='download.php?id=$attachment_id[$i]' target='_blank'><img src='img/file_small.gif' alt='attachment' /></a></td><td><a href='delete.php?type=attachment&id=$attachment_id[$i]&attachment=$attachment_path[$i]&back=editDefectPopup.php?d_id=$d_id' onclick='return confirm($confirm)'><img src='img/trashcan.gif' alt='".$lh->getText('Delete')."'/></a></td>";
        echo "</tr>";
      }

  	
  	echo "</table>";
    

    
    echo "<input name='uploadedfile' type='file' /><br />"; 

  	echo "<b>".$lh->getText('Decription').":</b>";
  	echo "<br />";
  	echo "<textarea cols='113' rows='15' name='description'>".$description."</textarea>";
  	echo "<br />";
  	echo "<input type='submit' value='".$lh->getText('Submit')."' />";
  	echo "</form>";
  	if($d_id!=''){
    	echo "<a onclick=".'"'."window.open('addComment.php?table=TRM_defects&id=".$d_id."','mitvindue2','height=250,width=180,resizable=no,scrolling=no');return false;".'"'." style='cursor: pointer;'>".$lh->getText('Add comment')."</a>";
    	echo "<br />";
    	echo "<br />";
    	echo "<b>".$lh->getText('Comments').":</b>";
    	echo "<br />";
    	echo "<div style='width: 600px; height: 300px; overflow: auto;'>";
    	$commentresult = $dbh->select('TRM_comments, TRM_users',
      "WHERE TRM_comments.table_name='TRM_defects' AND
       TRM_comments.table_id='$d_id' AND
       TRM_comments.author=TRM_users.ID ORDER BY TRM_comments.ID ASC",
       'TRM_comments.timedate as timedate,
        TRM_comments.headline as headline,
        TRM_comments.comment as comment,
        TRM_users.name as author
       ');
  
      while($row2 = mysql_fetch_array($commentresult)){
      	$timedate=$row2['timedate'];
      	$author=$row2['author'];
      	$headline=$row2['headline'];
      	$comment=$row2['comment'];
      	
        echo "$timedate $author <b>$headline</b>
        <br />
        ".nl2br($comment)."
        <br />
        <hr />";
      }
      echo "</div>";
    }
  ?>
  </body>
</html>
