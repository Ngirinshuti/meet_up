<?php
session_start();
session_destroy();
setcookie("name","",-20);
setcookie("password","",-20);
header("location:index.php");

?>