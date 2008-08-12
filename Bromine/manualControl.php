<?php include_once ('protected.php') ?>
<?php
$td_id = $_GET['td_id'];
$t_id = $_GET['t_id'];
$s_id = $_GET['s_id'];
$i = $_GET['i'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include ('header.php'); ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script language="JavaScript" src="js/prototype.js"></script>
    <script language="JavaScript">
      //alert('asdsa');
      function updateStatus(status1,cd_id1){ 
        //alert(status1 + cd_id1) 
        new Ajax.Updater('answer','/saveManStatus.php', {
        method: 'get',
        parameters: {status: status1, t_id: <?php echo $t_id; ?>, cd_id: cd_id1, s_id: <?php echo $s_id; ?>}
        });
      }
    </script>
  </head>
  <body>
    <?php
if ($i < 0 || !isset($_GET['i'])) {
    $i = 0;
}
$result = $dbh->select('TRM_design_manual_commands as commands, TRM_design_manual_test as test', "WHERE commands.td_id=$td_id AND test.id=$td_id ORDER BY commands.id ASC", 'commands.id as cd_id, commands.action as action, commands.reaction as reaction, test.name as name');
$num = mysql_num_rows($result);
if ($i == $num) {
    $i = $num-1;
    echo "<h1>Test done!</h1><br />";
};
while ($row = mysql_fetch_array($result)) {
    $t_name = $row['name'];
    $cd_id[] = $row['cd_id'];
    $action[] = $row['action'];
    $reaction[] = $row['reaction'];
}
$statusResult = $dbh->select('TRM_commands', "WHERE t_id=$t_id ORDER BY id ASC", 'id');
if (mysql_num_rows($statusResult) > 0) {
    $c_id = @mysql_result($statusResult, $i, 'id');
}
echo "$t_name<br />";
echo "<table>";
echo "<tr>";
echo "<td colspan='3'><b>You do:</b><br />";
echo "<textarea cols='20' rows='6' readonly>$action[$i]</textarea>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan='3'><b>System answers:</b><br />";
echo "<textarea cols='20' rows='6' readonly>$reaction[$i]</textarea>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan='3'>shift-alt-Q/W/E for pass/fail/skip</td>";
echo "</tr>";
echo "<tr>";
echo "<th align='left' valign='top'>Pass<br /><a accesskey='Q' href='saveManStatus.php?status=passed&cd_id=$cd_id[$i]&t_id=$t_id&i=$i&td_id=$td_id&c_id=$c_id&action=$action[$i]&reaction=$reaction[$i]&s_id=$s_id'><img src='img/check.gif' style='height: 15px;'/></a></th>";
echo "<th align='left' valign='top'>Fail<br /><a accesskey='W' href='saveManStatus.php?status=failed&cd_id=$cd_id[$i]&t_id=$t_id&i=$i&td_id=$td_id&c_id=$c_id&action=$action[$i]&reaction=$reaction[$i]&s_id=$s_id'><img src='img/functionality.png' style='height: 15px;'/></th>";
echo "<th align='left' valign='top'>Skip<br /><a accesskey='E' href='saveManStatus.php?status=notdone&cd_id=$cd_id[$i]&t_id=$t_id&i=$i&td_id=$td_id&c_id=$c_id&action=$action[$i]&reaction=$reaction[$i]&s_id=$s_id'><img src='img/arrowYellow.gif' style='height: 15px;' /></th>";
echo "<!--th align='left' valign='top'><img src='img/statusOpen.gif' style='height: 15px;'/></th-->";
echo "</tr>";
echo "</table>";
$result = $lh->select('TRM_commands', "WHERE t_id=$t_id ORDER BY id ASC", '*');
$num = mysql_num_rows($result);
echo "<br /><table border='0' width='100%' cellspacing='0' cellpadding='0' height='36'>";
echo "<tr>";
echo "<th align='left' valign='top'>Nr</th>";
echo "<th align='left' valign='top'>Step</th>";
echo "<th align='left' valign='top'>Status</th>";
echo "</tr>";
for ($u = 0;$u < $num;$u++) {
    if ($bgcolor == '') {
        $bgcolor = 'lightgrey';
    } else {
        $bgcolor = '';
    }
    if (mysql_result($result, $u, 'status') != '') {
        $status = mysql_result($result, $u, 'status');
    } else {
        $status = "N/A";
    }
    echo "<tr style='background-color: $bgcolor;'>";
    echo "<td>" . ($u+1) . "</td>";
    echo "<td";
    if ($u == $i) {
        echo " style= 'font-weight: bold;'";
    }
    echo "><a href='?i=$u&t_id=$t_id&td_id=$td_id&s_id=$s_id'>$action[$u]</a></td>";
    if ($status == 'passed') {
        $changeTo = "failed";
    } elseif ($status == 'failed') {
        $changeTo = 'notdone';
    } elseif ($status == 'notdone') {
        $changeTo = 'passed';
    }
    echo "<td class='status_$status'>$status</td>";
    echo "</tr>";
}
echo "</table>";
?>
    
  </body>
</html>
