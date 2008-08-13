<?php include ('protected.php'); ?>
<?php include ('header.php'); ?>

<?php
$user = $_SESSION['id'];
$headline = $_POST['headline'];
$comment = $_POST['comment'];
$table_name = $_POST['table_name'];
$table_id = $_POST['table_id'];
$dbh->insert('trm_comments', "NULL,CURRENT_TIMESTAMP,'$user','$headline','$comment','$table_name','$table_id'", "id,timedate,author,headline,comment,table_name,table_id");
echo "<p style='font-family: verdana; font-size: 10;'>" . $lh->getText('Comment added') . "</p>";
?>
