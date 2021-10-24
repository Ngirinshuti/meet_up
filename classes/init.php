<?php
// intialization file

session_start();

$dir = __DIR__;
require  $dir . "/../config.php";
// require 'user.php';
require_once 'DB.php';
require 'friend_system.php';
require 'message.php';
require 'date.php';
require $ROOT_DIR.  '/./auth/Auth.php';

if (!($current_user = Auth::currentUser())) {
    session_destroy();
    header("Location: $ROOT_URL/auth/index.php");
    exit("Not authenticated");
}

$db_connection  = DB::conn();
// $user_obj       = new User($db_connection, $_SESSION["a_user"]);
$friend_obj     = new Friends($db_connection, $_SESSION["a_user"]);
$msg_obj        = new Message($db_connection, $_SESSION["a_user"]);
$date_obj       = new Dates();

$req_num        = $friend_obj->get_friend_requests(false);
$active_friends = $friend_obj->active_friends();
// $users          = $user_obj->get_all_users(true);
// $users_num      = $user_obj->get_all_users(false);
$me             = &$current_user;
$unread         = $msg_obj->get_all_unread();
