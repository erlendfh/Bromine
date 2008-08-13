<?php include ('protected.php'); ?>
<?php
$d_id = $_POST['d_id'];
$name = $_POST['name'];
$type = $_POST['type'];
$stt = $_POST['stt'];
$status = $_POST['status'];
$description = $_POST['description'];
$priority = $_POST['priority'];
$p_name = $_SESSION['p_name'];
$target_path = "Attachments/";
$orgname = $_FILES["uploadedfile"]["name"];
$file_type = $_FILES["uploadedfile"]["type"];
$file_size = $_FILES["uploadedfile"]["size"];
$file_tempname = $_FILES['uploadedfile']['tmp_name'];
$t_id = 'NULL';
if (isset($_POST['t_id'])) {
    $t_id = $_POST['t_id'];
}
$user = $_SESSION['id'];
$p_id = $_SESSION['p_id'];
//DEFECT UPDATER
if ($d_id != '' && $name != '' && $type != '' && $status != '' && $description != '' && $priority != '') {
    $dbh->update('trm_defects', "name = '$name', type_of_defect=$type, status=$status, description='$description', updatedby=$user, priority='$priority', stt_id='$stt'", "ID = $d_id");
}
//DEFECT INSERTER
elseif ($name != '' && $type != '' && $status != '' && $description != '' && $d_id == '' && $priority != '') {
    $d_id = $dbh->insert('trm_defects', "NULL,'$name', '$type', '$status', '$description', '$user', NOW(), '$p_id', '$user', $t_id, '$priority', '$stt'", 'ID, name, type_of_defect, status, description, createdby, created, p_id, updatedby, t_id, priority, stt_id');
} else {
    $error = "&error=" . $lh->getText("All fields must be filled out");
}
if ($file_tempname != '') {
    if ($file_size < 10000000) {
        $microtime = str_replace('.', '', microtime('U'));
        $file_name_total = $target_path . $orgname . "_" . $microtime;
        $dbh->insert('trm_defect_has_attachment', "NULL,'$d_id','$file_name_total','$microtime'", "id, d_id, attachment_path, microtime");
        if (move_uploaded_file($file_tempname, $file_name_total)) {
            $response = "The file $orgname has been uploaded as $file_name_total";
            if ($overwrite) {
                $response.= ' and has replaced the older version';
            }
            chmod($file_name_total, 0777);
        } else {
            $response = "There was an error uploading the file, please try again!<br />Return Code: " . $_FILES["uploadedfile"]["error"] . "<br />";
        }
    } else {
        $response = "Det skal være en PHP/RB fil og den skal være mindre end 250 kb!";
    }
}
header("Location: editDefectPopup.php?d_id=$d_id$error");
?>
