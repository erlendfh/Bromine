<?php include_once ('protected.php'); ?>
<?php
//$dbh->insert('TRM_manual_test',"NULL,'$td_id', NOW(), '$u_id'",'ID, td_id, timedate, author');
$t_id = $_GET['t_id'];
$td_id = $_GET['td_id'];
$s_id = $_GET['s_id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include ('header.php'); ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <table>
      <tr valign='top'>
        <td style='width: 16%;'>
          <iframe src='manualControl.php?td_id=<?php echo $td_id; ?>&t_id=<?php echo $t_id; ?>&s_id=<?php echo $s_id; ?>' style='border: none; width: 100%; height: 700px;'>
          </iframe>
        </td>
        <td style='width: 84%;'>
          <iframe src='<?php echo $_GET['sitetotest']; ?>' style='border: 1px solid black; width: 100%; height: 700px;'>
          </iframe>
        </td>
      </tr>
    </table>
  </body>
</html>
