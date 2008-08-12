<?php
    include_once ('getprotect.php');
    $dbh = new DBHandler();
    header('Content-Type: text/html; charset=ISO-8859-1');
    $time = $_GET['time'];
    $u_id = $_GET['u_id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include ('header.php'); ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>

    <?php
        function getTime($time) {
            $min = floor(((time() -$time) /60));
            $sec = (time() -$time) -$min*60;
            if ($min < 10) {
                $min = "0" . $min;
            }
            if ($sec < 10) {
                $sec = "0" . $sec;
            }
            return "$min:$sec";
        }
        echo "<b>Started: " . date('Y-m-d H:i:s', $time) . "</b><br />";
        echo "<b>Elapsed: " . getTime($time) . "</b>";
    ?>
    <br /><br />
    <table width='800'>
      <tr>
        <th>Action</th>
        <th>var1</th>
        <th>var2</th>
      </tr>
    <?php
        $tempcommands = $dbh->select('TRM_tempcommands', "WHERE u_id='$u_id' ORDER BY id DESC LIMIT 0,200", "*");
        while ($row = mysql_fetch_array($tempcommands)) {
            $action = $row['action'];
            $var1 = $row['var1'];
            $var2 = $row['var2'];
            $status = $row['status'];
            echo "<tr class='status_$status'>";
            echo "<td>$action</td><td>$var1</td><td>$var2</td>";
            echo "</tr>";
        }
        if ($_GET['del'] == '1') {
            sleep(3);
            $dbh->delete("TRM_tempcommands", "u_id=$u_id");
        }
    ?>
    </table>
  </body>
</html>
