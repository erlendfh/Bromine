<?php include ('protected.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <?php include 'header.php'; ?>
  	<link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
<?php 
require 'menu.php';
BromineSubmenu::renderTestLabSubmenu();
?>
    <p><?php echo $_GET['response']; ?></p>
    <?php
$p_id = $_SESSION['p_id'];
$p_name = $_SESSION['p_name'];
$gettype = $_GET['gettype'];
$getname = $_GET['getname'];
if ($p_id != '') { ?>
    <table>
      <tr valign='top'>
        <td>
        <form action="" method="get">
        <table>
        <tr>
        <td><?php echo $lh->getText('Choose type'); ?>:</td>
        <td>
          <select name='gettype' onchange='this.form.submit()'>
            
            <?php
    echo "<option value=''>" . $lh->getText('Choose') . "</option>";
    $sql = 'SELECT * FROM TRM_types';
    $result = $dbh->sql($sql);
    for ($i = 0;$i < mysql_num_rows($result);$i++) {
        $type = mysql_result($result, $i, 'typename');
        echo "<option value='$type' ";
        if ($gettype == $type) {
            echo "selected='selected'";
        }
        echo ">$type</option>";
    }
?>
          </select>
        </td>
        </tr>
        <?php if ($gettype != '') { ?>
        <?php
        $path = "RC/$gettype/$p_name";
        if ($handle = @opendir($path)) {
            while (false !== ($file = readdir($handle))) {
                if (!is_dir("$path/$file")) {
                    $files[] = current(explode('.', $file));
                    $files2[] = $file;
                }
            }
            closedir($handle);
        }
?>
          <tr>
          <td><?php echo $lh->getText('testcase equals test'); ?></td>
          <td>
            <select name='getname' onchange='this.form.submit()'>
              <?php
        echo "<option value=''>" . $lh->getText('Choose') . "</option>";
        $sql = "SELECT name FROM TRM_design_manual_test WHERE p_id=$p_id";
        $nameresult = $dbh->sql("$sql");
        while ($row = mysql_fetch_array($nameresult)) {
            $names[] = $row['name'];
        }
        foreach($names as $name) {
            echo "<option value='$name' ";
            //if(is_array($files)){if(in_array($name,$files)){echo "disabled='disabled'";}}
            if ($getname == $name) {
                echo "selected='selected'";
            }
            echo ">$name ";
            if (is_array($files)) {
                if (in_array($name, $files)) {
                    echo "(" . $lh->getText('Already uploaded') . ")";
                }
            }
            echo "</option>";
        }
?>
            </select>
          </td>
          </tr>
        <?php
    } ?>
        </table>
      </form>
      <?php if ($getname != '' && $gettype != '') { ?>
        <form enctype="multipart/form-data" action='uploader.php' method='POST'>
          <table>
          <tr>
            <td><?php echo $lh->getText('Choose a file to upload'); ?>:</td>
            <td>
              <input type='hidden' name='type' value='<?php echo $gettype; ?>' />
              <input type='hidden' name='name' value='<?php echo $getname; ?>' />
              <input name="uploadedfile" type="file" />
            </td>
          </tr>
          <tr>
          <td>
            <input type="submit" value="Upload File" />
          </td>
          </tr>
          </table>
        </form>
      <?php
    } ?>
    <?php
} ?>
    </td>
    <td>
      <?php
if ($gettype != '') {
    echo "<b>" . $lh->getText('Already uploaded tests') . ":</b><br /><br />";
    if (is_array($files2)) {
        foreach($files2 as $file) {
            echo "$file<br />";
        }
    }
}
?>
    </td>
    </tr>
    </table>
    <div><a href='advanced_ftp.php'><?php echo $lh->getText('Advanced FTP functionality'); ?></a></div>
  </body>
</html>
