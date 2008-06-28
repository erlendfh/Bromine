<?php require 'protected.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include ('header.php'); ?>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <?php 
            require 'menu.php';
            BromineSubmenu::renderTestLabSubmenu();
        ?>
        <?php
            $p_id = $_SESSION['p_id'];
            $p_name = $_SESSION['p_name'];
            $gettype = str_replace(array('/','..'),'',$_GET['gettype']);
            $getfile = str_replace(array('/','..'),'',$_GET['getfile']);
            
        ?>
        <form action='' method='get'>
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
            <br />
            <?php 
                if ($gettype != '') {
                    $path = "RC/$gettype/$p_name/data";
                    if ($handle = @opendir($path)) {
                        while (false !== ($file = readdir($handle))) {
                            if (!is_dir("$path/$file")) {
                                $files[] = $file;
                            }
                        }
                        closedir($handle);
                    }
                    
                    echo "<select name='getfile' onchange='this.form.submit()'>";
                     
                    foreach($files as $file){
                        echo "<option value='$file' ";
                        echo ($getfile==$file ? "selected='selected'":"");
                        echo ">$file</option>";
                    }
                    echo "</select>";
                }
            ?>
            </form>
            <?php 
                if ($gettype != '' && $getfile!='') {
                    echo "<form action='saveData.php' method='post'>";
                    echo "<input type='text' name='postname' value='$getfile' />";
                    echo "<br />";
                    echo "<input type='hidden' name='posttype' value='$gettype' />";
                    echo "<input type='hidden' name='postfile' value='$getfile' />";
                    echo "<textarea name='data' cols='100' rows='40'>";
                    echo file_get_contents("RC/$gettype/$p_name/data/$getfile");
                    echo "</textarea>";
                    echo "<br />";
                    echo "<input type='submit' value='".$lh->getText('Submit')."'>";
                    echo "</form>";
                }
            ?>
        
    </body>
</html>