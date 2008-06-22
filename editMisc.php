<?php include ('protected.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  	<?php include ('header.php'); ?>
  	<link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
<?php 
include ('menu.php');
    $submenu = new BromineSubmenu();
    $submenu->admin();
    $submenu->display();    
    
$confirm = '"' . $lh->getText('confirmDelete') . '"';
$dbh = new DBHandler();
?>
    <form action='saveMisc.php' method='post'>
      <fieldset style='width: 600px;'>
        <legend style='cursor: pointer;' onclick="$('types').toggle()"><?php echo $lh->getText('Types') ?></legend>
        <div id='types' style="display:none;">
          <table>
            <?php
$result = $dbh->select('TRM_types', '', '*');
$num = mysql_numrows($result);
for ($i = 0;$i < $num;$i++) {
    $t_id = mysql_result($result, $i, "ID");
    $typename = mysql_result($result, $i, "typename");
    echo "<tr>";
    echo "<td>";
    echo "<input type='hidden' value='$t_id' name='t_id[]' />";
    echo "<input type='text' name='typename[]' value='$typename' size='20' />";
    echo "</td>";
    echo "<td><a href='delete.php?type=type&amp;id=$t_id&amp;back=editMisc.php' onclick='return confirm($confirm)' ><img src='img/trashcan.gif' alt='" . $lh->getText('Delete') . "'/></a></td>";
    echo "</tr>";
}
?>
            <tr>
              <td><?php echo $lh->getText('Add type'); ?></td>
            </tr>
            <tr>
              <td><input type='text' name='newtypename' size='20' /></td>
            </tr>
          </table>
        </div>
      </fieldset>
      <fieldset style='width: 600px;'>
        <legend style='cursor: pointer;' onclick="$('browsers').toggle()"><?php echo $lh->getText('Browsers') ?></legend>
        <div id='browsers' style="display:none;">
        <table>
          <?php
$result = $dbh->select('TRM_browser', '', '*');
$num = mysql_numrows($result);
for ($i = 0;$i < $num;$i++) {
    $b_id = mysql_result($result, $i, "ID");
    $browsername = mysql_result($result, $i, "browsername");
    echo "<tr>";
    echo "<td>";
    echo "<input type='hidden' value='$b_id' name='b_id[]' />";
    echo "<input type='text' name='browsername[]' value='$browsername' size='20' />";
    echo "</td>";
    echo "<td><a href='delete.php?type=browser&amp;id=$b_id&amp;back=editMisc.php' onclick='return confirm($confirm)' ><img src='img/trashcan.gif' alt='" . $lh->getText('Delete') . "'/></a></td>";
    echo "</tr>";
}
?>
          <tr>
            <td><?php echo $lh->getText('Add browser'); ?></td>
          </tr>
          <tr>
            <td><input type='text' name='newbrowsername' size='20' /></td>
          </tr>
        </table>
        </div>
      </fieldset>
      <fieldset style='width: 600px;'>
        <legend style='cursor: pointer;' onclick="$('OS').toggle()"><?php echo $lh->getText('OS') ?></legend>
        <div id='OS' style="display:none;">
          <table>
            <?php
$result = $dbh->select('TRM_OS', '', '*');
$num = mysql_numrows($result);
for ($i = 0;$i < $num;$i++) {
    $o_id = mysql_result($result, $i, "ID");
    $OSname = mysql_result($result, $i, "OSname");
    echo "<tr>";
    echo "<td>";
    echo "<input type='hidden' value='$o_id' name='o_id[]' />";
    echo "<input type='text' name='OSname[]' value='$OSname' size='20' />";
    echo "</td>";
    echo "<td><a href='delete.php?type=OS&amp;id=$o_id&amp;back=editMisc.php' onclick='return confirm($confirm)' ><img src='img/trashcan.gif' alt='" . $lh->getText('Delete') . "'/></a></td>";
    echo "</tr>";
}
?>
            <tr>
              <td><?php echo $lh->getText('Add OS'); ?></td>
            </tr>
            <tr>
              <td><input type='text' name='newOSname' size='20' /></td>
            </tr>
          </table>
        </div>
      </fieldset>
      <fieldset style='width: 600px;'>
        <legend style='cursor: pointer;' onclick="$('usertypes').toggle()"><?php echo $lh->getText('Usertypes') ?></legend>
        <div id='usertypes' style="display:none;">
        <table>
          <tr>
          <th><?php echo $lh->getText('Guest name'); ?></th>
          <th><?php echo $lh->getText('Guest password'); ?></th>
          </tr>
            <?php
$result = $dbh->select('TRM_users', 'WHERE ID=1', '*');
$name = mysql_result($result, 0, "name");
$password = mysql_result($result, 0, "password");
echo "<tr>";
echo "<td>";
echo "<input type='text' name='guestname' value='$name' size='7' />";
echo "</td>";
echo "<td>";
echo "<input type='text' name='guestpass' value='$password' size='7' />";
echo "</td>";
echo "</tr>";
?>
            <tr>
              <th colspan='3' style='background: rgb(211, 211, 211);'></th>
            </tr>
            <tr>
              <th colspan='3'><?php echo $lh->getText('Usertype'); ?></th>
            </tr>
            <?php
$result = $dbh->select('TRM_usertypes', '', '*');
$num = mysql_numrows($result);
for ($i = 0;$i < $num;$i++) {
    $ut_id = mysql_result($result, $i, "ID");
    $name = mysql_result($result, $i, "name");
    echo "<tr>";
    echo "<td colspan='2'>";
    echo "<input type='hidden' name='ut_id[]' value='$ut_id' />";
    echo "<input type='text' name='utname[]' value='$name' size='30' />";
    echo "</td>";
    echo "<td><a href='delete.php?type=usertype&amp;id=$ut_id&amp;back=editMisc.php' onclick='return confirm($confirm)' ><img src='img/trashcan.gif' alt='" . $lh->getText('Delete') . "'/></a></td>";
    echo "</tr>";
}
?>
            <tr>
              <td><?php echo $lh->getText('Add usertype'); ?></td>
            </tr>
            <tr>
              <td colspan='2'><input type='text' name='newutname' size='30' /></td>
            </tr>
          </table>
        </div>
      </fieldset>
      <fieldset style='width: 600px;'>
        <legend style='cursor: pointer;' onclick="$('pages').toggle()"><?php echo $lh->getText('Sites') ?></legend>
        <div id='pages' style="display:none;">
          <table>
            <tr>
              <th><?php echo $lh->getText('Site'); ?></th>
              <th><?php echo $lh->getText('Description'); ?></th>
            </tr>
            <?php
$result = $dbh->select('TRM_sites', 'ORDER BY sitename ASC', '*');
$num = mysql_numrows($result);
for ($i = 0;$i < $num;$i++) {
    $s_id = mysql_result($result, $i, "ID");
    $sitename = mysql_result($result, $i, "sitename");
    $description = mysql_result($result, $i, "description");
    $status = 'passed';
    if (!is_file($sitename)) {
        $status = 'failed';
    }
    echo "<tr>";
    echo "<td>";
    echo "<input type='hidden' value='$s_id' name='s_id[]' />";
    echo "<input class='status_$status' type='text' name='sitename[]' value='$sitename' size='25' />";
    echo "</td>";
    echo "<td><input type='text' name='description[]' value='$description' size='25' /></td>";
    echo "<td><a href='delete.php?type=site&amp;id=$s_id&amp;back=editMisc.php' onclick='return confirm($confirm)' ><img src='img/trashcan.gif' alt='" . $lh->getText('Delete') . "'/></a></td>";
    echo "</tr>";
}
?>
            <tr>
              <td><?php echo $lh->getText('Add site'); ?></td>
            </tr>
            <tr>
              <td><input type='text' name='newsitename' size='25' /></td>
              <td><input type='text' name='newdescription' size='25' /></td>
            </tr>
          </table>
        </div>
      </fieldset>
      <!--
      <fieldset style='width: 600px;'>
        <legend style='cursor: pointer;' onclick="$('config').toggle()"><?php echo $lh->getText('Config') ?></legend>
        <div id='config' style="display:none;">
          <table>
            <tr>
              <th><?php echo $lh->getText('Variable'); ?></th>
              <th><?php echo $lh->getText('Value'); ?></th>
            </tr>
            <?php
/*
$result = $dbh->select('TRM_config','','*');
$num=mysql_numrows($result);
for($i=0;$i<$num;$i++){
$v_id=mysql_result($result,$i,"ID");
$var=mysql_result($result,$i,"var");
$value=mysql_result($result,$i,"value");
echo "<tr>";
echo "<td>";
echo "<input type='hidden' value='$v_id' name='v_id[]' />";
echo "$var";
echo "</td>";
echo "<td><input type='text' name='value[]' value='$value' size='25' /></td>";
echo "</tr>";

}
*/
?>
          </table>
        </div>
      </fieldset>
      -->
      <fieldset style='width: 600px;'>
        <legend style='cursor: pointer;' onclick="$('defect_management').toggle()"><?php echo $lh->getText('Defect management') ?></legend>
        <div id='defect_management' style="display:none;">
          <table>
            <?php
$result = $dbh->select('TRM_defect_management', "WHERE `key` = 'useoutside'", '*');
$dms_key = mysql_result($result, 0, "key");
$value = mysql_result($result, 0, "value");
echo "<tr>";
echo "<td>";
echo "<input type='hidden' value='$dms_key' name='dms_useoutside' />";
echo $lh->getText('use outside defect system');
echo "</td>";
echo "<td><input type='text' name='dms_useoutside' value='$value' size='25' /></td>";
echo "</tr>";
$result = $dbh->select('TRM_defect_management', "WHERE `key` = 'viewurl'", '*');
$dms_key = mysql_result($result, 0, "key");
$value = mysql_result($result, 0, "value");
echo "<tr>";
echo "<td>";
echo "<input type='hidden' value='$dms_key' name='dms_viewurl' />";
echo $lh->getText('show defects url');
echo "</td>";
echo "<td><input type='text' name='dms_viewurl' value='$value' size='25' /></td>";
echo "</tr>";
$result = $dbh->select('TRM_defect_management', "WHERE `key` = 'addurl'", '*');
$dms_key = mysql_result($result, 0, "key");
$value = mysql_result($result, 0, "value");
echo "<tr>";
echo "<td>";
echo "<input type='hidden' value='$dms_key' name='dms_addurl' />";
echo $lh->getText('add defect url');
echo "</td>";
echo "<td><input type='text' name='dms_addurl' value='$value' size='25' /></td>";
echo "</tr>";
?>
          </table>
        </div>
      </fieldset>
      <fieldset style='width: 600px;'>
        <legend style='cursor: pointer;' onclick="$('defect_type').toggle()"><?php echo $lh->getText('Type of defect') ?></legend>
        <div id='defect_type' style="display:none;">
          <table>
            <tr>
              <th><?php echo $lh->getText('Type of defect'); ?></th>
              <th><?php echo $lh->getText('Priority'); ?></th>
              <th><?php echo $lh->getText('Image path'); ?></th>
            </tr>
            <?php
$result = $dbh->select('TRM_type_of_defects', '', '*');
$num = mysql_numrows($result);
for ($i = 0;$i < $num;$i++) {
    $tod_id = mysql_result($result, $i, "ID");
    $name = mysql_result($result, $i, "name");
    $priority = mysql_result($result, $i, "priority");
    $imgpath = mysql_result($result, $i, "imgpath");
    echo "<tr>";
    echo "<td>";
    echo "<input type='hidden' value='$tod_id' name='tod_id[]' />";
    echo "$name";
    echo "</td>";
    echo "<td><input type='text' name='type_priority[]' value='$priority' size='3' /></td>";
    echo "<td><input type='text' name='type_imgpath[]' value='$imgpath' size='25' /></td>";
    echo "</tr>";
}
?>
          </table>
        </div>
      </fieldset>
      <fieldset style='width: 600px;'>
        <legend style='cursor: pointer;' onclick="$('defect_status').toggle()"><?php echo $lh->getText('Type of defect status') ?></legend>
        <div id='defect_status' style="display:none;">
          <table>
            <tr>
              <th><?php echo $lh->getText('Type of defect status'); ?></th>
              <th><?php echo $lh->getText('Priority'); ?></th>
              <th><?php echo $lh->getText('Image path'); ?></th>
            </tr>
            <?php
$result = $dbh->select('TRM_type_of_defect_status', '', '*');
$num = mysql_numrows($result);
for ($i = 0;$i < $num;$i++) {
    $tods_id = mysql_result($result, $i, "ID");
    $name = mysql_result($result, $i, "name");
    $priority = mysql_result($result, $i, "priority");
    $imgpath = mysql_result($result, $i, "imgpath");
    echo "<tr>";
    echo "<td>";
    echo "<input type='hidden' value='$tods_id' name='tods_id[]' />";
    echo "$name";
    echo "</td>";
    echo "<td><input type='text' name='status_priority[]' value='$priority' size='3' /></td>";
    echo "<td><input type='text' name='status_imgpath[]' value='$imgpath' size='25' /></td>";
    echo "</tr>";
}
?>
          </table>
        </div>
      </fieldset>
      <div><input type='submit' value='<?php echo $lh->getText('Submit'); ?>' /></div>
    </form>
  </body>
</html>
