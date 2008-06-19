<?php
unlink("install.php");
unlink("sql.sql");
header('Location: /login.php');
?>
