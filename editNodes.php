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
    <?php      
      $dbh = new DBHandler();
    ?>

      <form action='saveNodes.php' method='post'>
              <table>
                <tr>
                  <th align='left'>  
                  </th>
                  <th align='left'>  
                    <?php echo $lh->getText('Node') ?>
                  </th>
                  <th align='left'>  
                    <?php echo $lh->getText('Network_drive') ?>
                  </th>
                  <th align='left'>
                    <?php echo $lh->getText('OS') ?>
                  </th>
                  <th align='left'>
                    <?php echo $lh->getText('Description') ?>
                  </th>
                  <th align='left'>
                    <?php echo $lh->getText('Browsers') ?>
                  </th>
                  <th align='left'>
                    <?php echo $lh->getText('Commands') ?>
                  </th>
                  <!--th align='left'>
                    <?php echo $lh->getText('Types') ?>
                  </th>
                  <th align='left'>
                    <?php echo $lh->getText('Type path') ?>
                  </th-->
                  <th align='left'>
                    <?php echo $lh->getText('Delete') ?>
                  </th>
                </tr>
                <?php
 
                  $browserlistresult=$dbh->select('TRM_browser',"ORDER BY ID","DISTINCT browsername, ID");
                  $browsernum=mysql_numrows($browserlistresult);
                  $OSlistresult=$dbh->select('TRM_OS',"ORDER BY ID","DISTINCT OSname, ID");
                  $OSnum=mysql_numrows($OSlistresult);
                  $typelistresult = $dbh->select('TRM_types',"ORDER BY ID",'DISTINCT typename, ID');
                  $typenum=mysql_numrows($typelistresult);
                  
                  
                  $result=$dbh->select('TRM_nodes, TRM_OS',"
                      WHERE TRM_nodes.o_id=TRM_OS.ID",
                      "*");
                  $numreports=mysql_numrows($result);
                  for($i=0;$i<$numreports;$i++){
                  
                    $n_id=mysql_result($result,$i,"ID");
                    $nodepath=mysql_result($result,$i,"nodepath");
                    $description=mysql_result($result,$i,"description");
                    $o_idcur=mysql_result($result,$i,"o_id");
                    $network_drive=mysql_result($result,$i,"network_drive");                   
                    echo "
                    <script type='text/javascript'>
                      new Ajax.Updater('div$n_id' ,'portscan.php', {
                      method: 'get',
                      parameters: {host: '$nodepath'}
                      });
                    </script>";
                    
                    
                    echo "<tr valign='top'>";
                    echo "<td>";
                    echo "<div id='div$n_id'></div>";
                    echo "</td>
                    <td id='$n_id'>
                      <input type='hidden' value='$n_id' name='n_id[]' />
                      <input type='text' value='$nodepath' name='nodepath[]' size='20' />
                    </td>
                    <td>
                      <input type='text' value='$network_drive' name='network_drive[]' size='20' />
                    </td>
                    <td>
                    <select name='OS[]'>";
                      for($u=0;$u<$OSnum;$u++){
                        $o_id=mysql_result($OSlistresult,$u,"ID");
                        $OSname=mysql_result($OSlistresult,$u,"OSname");
                        echo "<option value='$o_id'";
                        if($o_idcur==$o_id){
                          echo " selected='selected'";
                        }
                        echo ">$OSname</option>";
                      }
                    echo "
                    </select>
                    </td>
                    <td>
                      <textarea cols='20' rows='3' name='description[]'>$description</textarea>
                    </td>
                    <td>";
                    echo "<select name='browsers[$n_id][]' multiple='multiple'>";
                    $browscurresult=$dbh->select('TRM_nodes_browsers',"WHERE n_id='$n_id' ORDER BY b_id","*");
                    $browserscur=Array();
                    while($row = mysql_fetch_array($browscurresult)){
                    	$browserscur['n_id'][]=$row['n_id'];
                      $browserscur['b_id'][]=$row['b_id'];
                      $browserscur['browser_path'][]=$row['browser_path'];
                    }
                    for($u=0;$u<$browsernum;$u++){
                      $b_id=mysql_result($browserlistresult,$u,"ID");
                      $browsername=mysql_result($browserlistresult,$u,"browsername");
                      echo "<option value='$b_id'";
                      if(is_array($browserscur['b_id'])){
                        if(in_array($b_id,$browserscur['b_id'])){
                          echo " selected='selected'";
                        }
                      }
                      echo ">$browsername</option>";
                    }
                    echo "
                    </select>
                    </td>";
                    
                    echo "<td>";
                  
                    for($c=0;$c<count($browserscur['n_id']);$c++){
                      $nc_id=$browserscur['n_id'][$c];
                      $b_id=$browserscur['b_id'][$c];
                      $browser_path=$browserscur['browser_path'][$c];
                      echo "<input type='text' value='$browser_path' name='browser_path[$nc_id][$b_id]' size='30'/><br />";  
                    }
                    
                    echo "</td>";
                    
 /*
                    $typecurresult = $dbh->select('TRM_nodes_types',"WHERE n_id='$n_id' ORDER BY t_id",'*');
                    $typescur=Array();
                    while($row = mysql_fetch_array($typecurresult)){
                    	$typescur['n_id'][]=$row['n_id'];
                      $typescur['t_id'][]=$row['t_id'];
                      $typescur['test_path'][]=$row['test_path'];
                    }
                    
                    echo "<td>";
                    echo "<select name='type[$n_id][]' multiple='true'>";
                      for($c=0;$c<$typenum;$c++){
                        $t_id=mysql_result($typelistresult,$c,"ID");
                        $typename=mysql_result($typelistresult,$c,"typename");
                        echo "<option value='".$t_id."'";
                        if(in_array($t_id,$typescur['t_id'])){echo " selected='selected'" ;}
                        echo ">".$typename."</option>";
                      }
                    echo "</select>
                    </td>";
                    
                    echo "<td>";
                    //print_r($typescur);
                    
                    for($c=0;$c<count($typescur['n_id']);$c++){
                      $nc_id=$typescur['n_id'][$c];
                      $t_id=$typescur['t_id'][$c];
                      $test_path=$typescur['test_path'][$c];
                      echo "<input type='text' value='$test_path' name='test_path[$nc_id][$t_id]' size='30'/><br />";  
                    }
                    
                    /*
                    $numtypes=mysql_numrows($typeresult);
                    for($c=0;$c<$numtypes;$c++){
                    $t_idc=mysql_result($typeresult,$c,"t_id");
                    $test_path=mysql_result($typeresult,$c,"test_path");
                      echo "<input type='text' value='$test_path' name='test_path[$n_id][$t_idc]'/><br />";  
                    }
                    
                    echo "</td>";
                    */
                    $confirm='"'.$lh->getText('confirmDelete').'"';
                    echo "<td><a href='delete.php?type=node&amp;id=$n_id&amp;back=editNodes.php' onclick='return confirm($confirm)' ><img src='img/trashcan.gif' alt='".$lh->getText('Delete')."'/></a></td>";

                    echo "</tr>";
                    
                  }
                
                
                ?>                
                <tr>
                <td>&nbsp;</td>
                  <td colspan='5'>
                    <?php echo $lh->getText('Add node') ?>
                  </td>
                </tr>
                <tr valign='top'>
                  <td>&nbsp;</td>
                  <td>
                    <input type='text' name='newpath' size='20' />
                  </td>
                  <td>
                    <input type='text' name='newnetwork_drive' size='20' />
                  </td>
                  <td>
                  <?php 
                    echo "<select name='newOS'>";
                      for($u=0;$u<$OSnum;$u++){
                        $o_id=mysql_result($OSlistresult,$u,"ID");
                        $OSname=mysql_result($OSlistresult,$u,"OSname");
                        echo "<option value='$o_id'>$OSname</option>";
                      }
                    echo "
                    </select>";
                    ?>
                  </td>
                  <td>
                    <textarea cols='20' rows='3' name='newdescription'></textarea>
                  </td>
                  <td>
                    <?php echo "<select name='newbrowsers[]' multiple='multiple'>";
                    for($u=0;$u<$browsernum;$u++){
                      $b_id=mysql_result($browserlistresult,$u,"ID");
                      $browsername=mysql_result($browserlistresult,$u,"browsername");
                      echo "<option value='$b_id'>$browsername</option>";
                    }
                    echo "
                    </select>";
                    ?>
                  </td>
                </tr>
              </table>
        <div><input type='submit' value='<?php echo $lh->getText('Submit'); ?>' /></div>
      </form>

  </body>
</html>
