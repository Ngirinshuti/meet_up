<?php
// intialization file
require_once __DIR__ . "/../auth/authenticate.php";

$dir = __DIR__;
require_once  $dir . "/../config.php";
require_once 'old_user.php';
require_once 'DB.php';
require_once 'friend_system.php';
require_once 'message.php';
require_once 'date.php';
require_once $ROOT_DIR.  '/./auth/Auth.php';


$db_connection  = DB::conn();
$user_obj       = new OldUser($db_connection, $me->username);
$friend_obj     = new Friends($db_connection, $me->username);
$msg_obj        = new Message($db_connection, $me->username);
$date_obj       = new Dates();

$req_num        = $friend_obj->get_friend_requests(false);
$active_friends = $friend_obj->active_friends();
$users          = $user_obj->get_all_users(true);
$users_num      = $user_obj->get_all_users(false);
$unread         = $msg_obj->get_all_unread();
