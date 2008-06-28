<?php include ('protected.php'); ?>
<?php
    //print_r($GLOBALS['_POST']);
    
    $p_name=$_SESSION['p_name'];
    $posttype = str_replace(array('/','..'),'',$_POST['posttype']);
    $postfile = str_replace(array('/','..'),'',$_POST['postfile']);
    $postname = $_POST['postname'];
    $data = $_POST['data'];
    
    file_put_contents("RC/$posttype/$p_name/data/$postname", $data);
    if($postfile!=$postname){
        unlink("RC/$posttype/$p_name/data/$postfile");
        $postfile=$postname;
    }
    header("Location: editData.php?gettype=$posttype&getfile=$postfile");
?>
