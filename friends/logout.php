<?php require "../classes/init.php";
	//session_start();
if (isset($_SESSION['a_user'])) {
$conn = new mysqli("localhost", "root", "", "project2");
$sql = "UPDATE users SET status = 'offline' WHERE username = '".$_SESSION['a_user']."'";
if ($conn->query($sql)) {

session_destroy();
setcookie("name",'',time()-7000000,'/');
setcookie("password",'',time()-7000000,'/');
setcookie("check",'',time()-7000000,'/');
unset($_SESSION['a_user']);
unset($_COOKIE['name']);
unset($_COOKIE['password']);
unset($_COOKIE['check']);
		header("location: ../index.php");
	
}
}else {
	
	header("location: ../index.php");
}
?>   