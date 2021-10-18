<?php session_start();
	require 'user.php';
	require 'db.php';
	require 'friend_system.php';
	require 'message.php';
	require 'date.php';

	$db_obj         = new Con();
	$db_connection  = $db_obj->create_connection();
	$user_obj       = new User($db_connection, $_SESSION["a_user"]);
	$friend_obj     = new Friends($db_connection, $_SESSION["a_user"]);
	$msg_obj        = new Message($db_connection, $_SESSION["a_user"]);
	$date_obj       = new Dates();

	if (!isset($_SESSION["a_user"]) || !$user_obj->user_exist($_SESSION["a_user"])) {
        session_destroy();
        setcookie("name",'',time()-7000000,'/');
setcookie("password",'',time()-7000000,'/');
setcookie("check",'',time()-7000000,'/');
		header("location: ../");
		exit;
	}

	$req_num        = $friend_obj->get_friend_requests(false);
	$active_friends = $friend_obj->active_friends();
	$users          = $user_obj->get_all_users(true);
	$users_num      = $user_obj->get_all_users(false);
	$me             = $user_obj->get_user_data($_SESSION["a_user"]);
	$unread         = $msg_obj->get_all_unread();

	// date_default_timezone_set("Africa/Kigali");

	// function getDateTimeDiff ($date)
	// {
	// 	$now_timestamp = strtotime(date("Y-m-d H:i:s"));
	// 	$diff_timestamp = $now_timestamp - strtotime($date);
	// 	$temp_date = date_create($date);
	// 	$realDate = date_format($temp_date, "H:i");

	// 	if($diff_timestamp < 60) {
	// 		return "now";
	// 	}
	// 	else if ($diff_timestamp >= 60 && $diff_timestamp < 3600) {
	// 		return (round($diff_timestamp/60) == 1) ? "1 min ago" : round($diff_timestamp/60)." mins ago";
	// 	}
	// 	else if ($diff_timestamp >= 3600 && $diff_timestamp < 86400) {
	// 		return (round($diff_timestamp/3600) == 1) ? "1 hour ago" : round($diff_timestamp/3600)." hours ago";
	// 	}
	// 	else if ($diff_timestamp >= 86400 && $diff_timestamp < (86400 * 30)) {
	// 		return (round($diff_timestamp/86400) == 1) ? "Yesterday at ".$realDate : round($diff_timestamp/86400)." days ago";
	// 	}
	// 	else if ($diff_timestamp >= (86400 * 30) && $diff_timestamp < (86400 * 365)) {
	// 		return (round($diff_timestamp/(86400 * 30)) == 1) ? "1 month ago" : round($diff_timestamp/(86400 * 30))." months ago";
	// 	}
	// 	else{
	// 		return (round($diff_timestamp/(86400 * 365)) == 1) ? "1 year ago" : round($diff_timestamp/(86400 * 365))." years ago";
	// 	}
	// }
?>
