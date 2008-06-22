<?php
@unlink("install.php");
@unlink("sql.sql");
header('Location: login.php?errormsg=login with username: admin and password: admin');
?>
