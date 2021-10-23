<?php 
    session_start();
    require 'user.php';
    require 'DB.php';
    require 'friend_system.php';
    require 'message.php';
    require 'date.php';

    $db_connection  = DB::conn();
    $user_obj       = new User($db_connection, $_SESSION["a_user"]);
    $friend_obj     = new Friends($db_connection, $_SESSION["a_user"]);
    $msg_obj        = new Message($db_connection, $_SESSION["a_user"]);
    $date_obj       = new Dates();

if (!isset($_SESSION["a_user"]) || !$user_obj->user_exist($_SESSION["a_user"])) {
        session_destroy();
        setcookie("name", '', time()-7000000, '/');
        setcookie("password", '', time()-7000000, '/');
        setcookie("check", '', time()-7000000, '/');
        header("location: ../");
    exit;
}

    $req_num        = $friend_obj->get_friend_requests(false);
    $active_friends = $friend_obj->active_friends();
    $users          = $user_obj->get_all_users(true);
    $users_num      = $user_obj->get_all_users(false);
    $me             = $user_obj->get_user_data($_SESSION["a_user"]);
    $unread         = $msg_obj->get_all_unread();

?>
