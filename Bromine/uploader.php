<?php
include ('protected.php');
//print_r($_FILES);
/*
Array
(
[uploadedfile] => Array
(
[name] => test.rb
[type] => application/octet-stream
[tmp_name] => /tmp/phpBrPhbS
[error] => 0
[size] => 38
)

)
*/
$file_name = $_POST['name'];
$type = $_POST['type'];
$p_name = $_SESSION['p_name'];
$target_path = "RC/$type/$p_name/";
$orgname = $_FILES["uploadedfile"]["name"];
$ext = end(explode('.', $orgname));
$file_type = $_FILES["uploadedfile"]["type"];
$file_size = $_FILES["uploadedfile"]["size"];
$file_tempname = $_FILES['uploadedfile']['tmp_name'];
$file_name_total = $target_path . $file_name . "." . $ext;
if (file_exists($file_name_total)) {
    $overwrite = true;
}
if ($ext!='' && $file_size < 250000) {
    if (move_uploaded_file($file_tempname, $file_name_total)) {
        $response = "The file $orgname has been uploaded as $file_name_total";
        chmod($file_name_total, 0777);
        if ($overwrite) {
            $response.= ' and has replaced the older version';
        }
    } else {
        $response = "There was an error uploading the file, please try again!<br />Return Code: " . $_FILES["uploadedfile"]["error"] . "<br />";
    }
} else {
    $response = "The file has to have an extension and be less than 250 kb!";
}
header("location: simpleFTP.php?response=$response&gettype=$type")
?>
