<?php session_start();
	if (isset($_SESSION["a_user"])) {
		header("location: friends/profile.php");
		exit;
	}
	require 'classes/user.php';
	require 'classes/db.php';
	$db_obj        = new Con('localhost', 'root', 'project2', '');
	$db_connection = $db_obj->create_connection();

	if (isset($_POST['register'])) {
		$fname    = test_input($_POST["fname"]);
		(isset($_POST['register'])) ? $lname = test_input($_POST["lname"]) : $lname = "";
		$dob      = test_input($_POST['dob']);
		$email    = test_input($_POST["email"]);
		$sex      = test_input($_POST["sex"]);
		$username = test_input($_POST["username"]);
		$password = test_input($_POST["password"]);
		 $_SESSION['email']=$email;
		  $code=mt_rand(100000,999999);
        $verify='not verified';
          $to = $email;
         $subject = "confirmation code";
         $message = $code;
         $header = "From:prudentenz001@gmail.com \r\n";    
         $retval = mail($to,$subject,$message,$header);

		$user_obj = new User($db_connection, $_SESSION['email']=$email);
	
			$register = $user_obj->register_user($fname, $lname, $email, $dob, $sex, $username, $password,$code,$verify);
	}

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/font-awesome-4.5.0/css/font-awesome.min.css">
<?php //require 'theme.php';?>
<link rel="stylesheet" href="css/style.css">
<title>signup</title>
</head>
<body class="w3-theme-l2">
<div class="formContainer">
	 <h2 class="header">MeetUp</h2>
        <p class="formText">MeetUp MeetThem</p>
<?php if(isset($register['Error'])){?>
<p class="w3-card-4" id="error"><?php echo $register['Error'];?></p>
<?php } if(isset($register['Success'])){?>
<p class="w3-card-4" id="success"><?php echo $register['Success'];?></p>
<?php } if(isset($register['Info'])){?>
<p class="w3-card-4" id="info"><?php echo $register['Info'];?></p>
<?php }?>
<form id="signup" method="post" enctype="multipart/form-data">
	<label>Firstname</label>
	<input type="text" name="fname" placeholder="Enter FirstName" required/>
	<label>Lastname   <span class="required"></span></label>
	<input type="text" name="lname" placeholder="Enter LastName"/>
	<label>Username</label>
	<input type="text" name="username" placeholder="Enter Username" required/>
	<label>E-mail</label>
	<input type="email" name="email" placeholder="Enter E-mail Address" required/>
	<label>Password</label>
	<div class="pwd">
	<input type="password" name="password" placeholder="Enter Password" required/></div><!--<div class="visible">
	<i id="visible" onclick="showHide(this.id)" class='fa fa-eye'></i>
	</div><br>-->
<label>Confirm Password</label>
	<div class="pwd">
	<input type="password" name="re_password" placeholder="Re-type Password" required/></div><!--<div class="visible">
	<i id="visible" onclick="hideshow(this.id1)" class='fa fa-eye'></i>
	</div><br>-->
		<label for="dob">Date Of Birth</label>
	<div class="date">
	<input type="date" name="dob">
	</div>
	<label>Gender:</label>
	<div id="radio" style="height: 1cm;"><table border="0"><tr><td>
		Male
			<input type="radio" name="sex" value="Male" required style="height: 0.4cm;"/></td><td>
			Female
			<input type="radio" name="sex" value="Female" required style="height: 0.4cm;"/></td></tr></table>
		
	</div>
	<div class="btm">
		<button type="submit" name="register">SignUp</button>
		<span>
			<span>Have account? </span>
			<a href="index.php" class="formLink">Login</a>
		</span><p class="formText" style="margin-left: 5cm;margin-top: -0.5cm;">
                By registering you agree to the MeetUp
                <a href="#" class="formLink">Terms of Use</a>
            </p>
	</div>
</form>
<!--h2 align="center" id="footer">&copy;Valentin.Inc</h2-->
</div>

<!--<script>
function showHide(id) {
	var element = document.getElementById(id);
	var passwordElement = document.getElementsByName("password")[0];
	element.classList.toggle("fa-eye-slash");
	if (passwordElement.type == "password") {
		passwordElement.type = "text";
	}else {
		passwordElement.type = "password";
	}
}
function hideshow(id1) {
	var element = document.getElementById(id1);
	var passwordElement = document.getElementsByName("re_password")[0];
	element.classList.toggle("fa-eye-slash");
	if (passwordElement.type == "password") {
		passwordElement.type = "text";
	}else {
		passwordElement.type = "password";
	}
}
</script>-->
</body>
</html>
