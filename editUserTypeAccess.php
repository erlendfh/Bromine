<?php include ('protected.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include ('header.php'); ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <?php include ('menu.php');
    $submenu = new BromineSubmenu();
    $submenu->admin();
    $submenu->display(); 

?>
    <form method='get' action=''>
      <table>
        <tr>
          <td>          
            <?php
$ut_id = $_GET['ut_id'];
$dbh = new DBHandler();
$result = $dbh->select('TRM_usertypes', "", "*");
$num = mysql_numrows($result);
echo "<select name='ut_id' onchange='this.form.submit()'>";
echo "<option value=''>" . $lh->getText('Choose usertype') . "</option>";
for ($i = 0;$i < $num;$i++) {
    echo "<option value='" . mysql_result($result, $i, "id") . "'";
    if ($ut_id == mysql_result($result, $i, "id")) {
        echo ' selected="selected"';
    }
    echo ">" . mysql_result($result, $i, "name") . "</option>";
}
echo "</select>";
$confirm = '"' . $lh->getText('confirmDelete') . '"';
?>
          </td>
        </tr>
      </table>
    </form>
    <?php if ($ut_id != '') { ?>
      <form action='saveUserTypeAccess.php' method='post'>
        <?php echo "<div><input type='hidden' name='ut_id' value='$ut_id' /></div>"; ?>
        <table>
          <tr>
            <th align='left'><?php echo $lh->getText('Access'); ?></th>
            <th align='left'><?php echo $lh->getText('Site'); ?></th>
            <th align='left'><?php echo $lh->getText('Description'); ?></th>
          </tr>
          
          <?php
    $result = $dbh->select('TRM_usertypes, TRM_usertype_access, TRM_sites', "WHERE TRM_usertypes.ID='$ut_id' AND
            TRM_usertypes.ID=TRM_usertype_access.ut_id AND
            TRM_usertype_access.s_id=TRM_sites.ID ORDER BY TRM_sites.sitename", '*');
    $num = mysql_numrows($result);
    for ($i = 0;$i < $num;$i++) {
        $uta_id = mysql_result($result, $i, "TRM_usertype_access.ID");
        $access = mysql_result($result, $i, "access");
        $sitename = mysql_result($result, $i, "sitename");
        $description = mysql_result($result, $i, "description");
        echo "<tr>";
        echo "<td><input type='checkbox' name='uta_id[]' value='$uta_id' ";
        if ($access == 1) {
            echo " CHECKED";
        }
        echo " /></td>";
        echo "<td>$sitename</td>";
        echo "<td>$description</td>";
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
