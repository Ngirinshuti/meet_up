<?php 
session_start();
if (!isset($_SESSION['pass'],$_SESSION['name'])) {
	header("location:index.php");
}
$name=$_SESSION['name'];
$pwd=$_SESSION['pass'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dashboard</title>
</head>
<body><fieldset style="width: 20cm;text-align: center;margin-left: 7cm;margin-top: 3cm;background-color: whitesmoke;">
<form method="post" action="logout.php">

<label><h2>Welcome here <span style="color: dodgerblue;"><i><?php echo $name; ?></i></span>!!</h2></label>
<input type="submit" name="logout" value="logout">
</form></fieldset>
</body>
</html>