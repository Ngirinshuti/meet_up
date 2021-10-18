<?php require '../classes/init.php';
	if (!isset($_SESSION["a_user"])) {
		header("location: ../friends/profile.php");
		exit;
	}
	


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<title>Home Page</title>
	<link rel="stylesheet" href="../css/font-awesome-4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/w3.css">
	<link rel="stylesheet" href="../css/style2.css">
	<link rel="stylesheet" href="../css/style.css">
	<?php require_once '../theme.php'; ?>
	<title>MeetUp MeetUs</title>
	<style type="text/css">
	.online-dot {
			background: linear-gradient(orange, green, yellow);
			padding: 6px;
			border: 1px solid green;
			max-width: 3px;
			max-height: 3px;
			font-size: 7px;
			box-shadow: 2px 2px 10px black, 5px 10px 20px black;
			bottom: 5%;
			border-radius: 50%;
			left: 70%;
			position: absolute;
		}
			.active-user-wrapper {
			padding: 3px 6px;
			position: relative;
			margin: 0 4px;
			width: 60px;
			cursor: pointer;
			display: flex;
			text-transform: capitalize;
			justify-content: center;
			align-items: center;
			flex-direction: column;
		}
		.active-user-image-wrapper {
			position: relative;
			background: transparent !important;
			width: 30px;
		}
		.username{
			margin-top: -1.1cm;
			margin-left: -5cm;
		}
		.btn{
		}
		
	</style>
</head>
<body class="w3-theme-l3">
	<div class="container w3-card-4 w3-theme-l4">
<?php require '../menu/menu.php'; ?>
<form method="post" enctype="multipart/form-data"><div class="btn">
<textarea placeholder="Write what you want to share with your friends here!" style="width: 80%;" name="text"></textarea></div><button type="submit" name="post"  style=" margin-left: 15.45cm;margin-top: -1.47cm;border: 0px;background-color: dodgerblue;width: 3cm;height: 1.3cm;">Post Now</button>
<input id="file" name="image" type="file" title="Picture" /><input type="file" name="video" title="Video">
 </form><hr>
 <div>
 	<?php 
 	
 	$user=$_SESSION["a_user"];

 if (isset($_GET['message'])) {
 	if ($_GET['message']=='empty') {
 		echo "Post is not submitted because you tried to send an empty post!";
 	}
 }
if (isset($_POST['post'])) {;
	$user_obj = new User($db_connection,$user);
$texts=$_POST['text'];
$dates=date('y/m/d H:i:s');
      $posting = $user_obj->create_post($texts,$dates,$user);
      if (isset($posting['Error'])) {
      	echo "<i style='color:green;font-size:25px;'>Post is not submitted because the submitted post was empty!</i>";
      	$sele=$user_obj->select_post(); 
      }

  }
  else
  {
  	$sele=$user_obj->select_post(); 
  }
  ?>
 </div>
</div>
</body>
</html>