<?php 
// logout file

$dir = __DIR__;

require_once $dir . "/../config.php";
require_once $dir . "/../classes/init.php";

$me->setProperty("status", "offline");

Auth::logout();

header("Location: $ROOT_URL/index.php");

exit("Logged out");