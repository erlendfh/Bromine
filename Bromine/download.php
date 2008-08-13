<?php
include ('protected.php');
$id = $_GET['id'];
$attachmentresult = $dbh->select('trm_defect_has_attachment', "WHERE id='$id'", '*');
while ($row = mysql_fetch_array($attachmentresult)) {
    $attachment_path[] = $row['attachment_path'];
    $microtime[] = $row['microtime'];
    $attachment_id[] = $row['id'];
}
$the_path = str_replace('_' . $microtime[0], '', $attachment_path[0]);
$filename = str_replace('Attachments/', '', $the_path);
$ext = end(explode('.', $the_path));
if ($ext == 'jpg') $ext = 'jpeg'; //Quick 'n dirty fix.
$toDisplay = array('jpeg', 'gif', 'bmp', 'png');
if (in_array($ext, $toDisplay)) {
    header("Content-type: image/$ext");
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');
    readfile($attachment_path[0]);
    exit;
} else {
    header("Content-type: application/$ext");
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');
    readfile($attachment_path[0]);
    exit;
}
?>



