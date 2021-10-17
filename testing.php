<?php
session_start();
include 'token.php';
 
$csrf = new csrf();
 
// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);
if($csrf->check_valid('post')) {
  var_dump($_POST[$token_id]);
} 
require 'classes/user.php';
  require 'classes/db.php';
  $db_obj        = new Con('localhost', 'root', 'project2', '');
  $db_connection = $db_obj->create_connection();
  //$email=$_GET['email'];
   $email=$_SESSION['email'];
if (isset($_POST['sub'])) {
$code=$_POST["code"];
$user_obj = new User($db_connection,$email);
      $verification = $user_obj->verify_user($code,$email);
      echo $email.$code;

}
?>
<?php
/*if (isset($_COOKIE['password'],$_COOKIE['name'])) {
  $pwd=$_COOKIE['password'];
  $name=$_COOKIE['name'];
  $_SESSION['name']=$name;
  $_SESSION['pass']=$pwd;
header("location:dashboard.php");
}
else
{*/
?>

<!DOCTYPE html>
<html>
    
<head>
  <title>Verify account</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=devive-width,initial-scale=1.0">
<link rel="stylesheet" href="css/style.css">
</head>
<body >
  <div class="formContainer">
    <h1 class="header">MeetUp</h1>
        <p ><h3 class="formText">MeetUp MeetThem</h3></p>
          <form id="verification" method="post" enctype="multipart/form-data">
            <h1 style="margin-left:0cm;">ACCOUNT VERIFICATION</h1>
            <br>
           <div class="input-group mb-3">
             
            <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Type your verification code here........ " name="code" required="">
  </div>
  
            <div class="form-group">
              <input type="hidden" name="<?= $token_id; ?>" value="<?= $token_value; ?>" />
            </div><br><br><br>
              <div class="d-flex justify-content-center mt-3 login_container" style="margin-top">
<button name="sub" type="submit"> Verify</button>
          <br><br><p class="formText">
          I have MeetUp account. <a href="index.php" class="formLink">Login</a> now!</p>
           </div>
          </form><br>
        <?php 
if (isset($_GET['conf'])) {
  if ($_GET['conf']=="sent") {
   echo "<p class='signupsuccess'>Verification code sent to your e-mail,check your email!</p>";
  }
}else if (isset($_GET['confi'])) {
  if ($_GET['confi']=="notsent") {
   echo "<p class='signupsuccess' style=''>Verification code not sent, try again!!</p>";
  }
}
else if (isset($_GET['message'])) {
  if ($_GET['message']=="code") {
   echo "<p class='signupsuccess' style=''>Verification code sent to your e-mail,check your email!</p>";
  }
}
else if (isset($_GET['message1'])) {
  if ($_GET['message1']=="wrong") {
   echo "<p class='signupsuccess' style=''>Wrong activation code!!!</p>";
  }
}

        ?>
        </div>
    <br>
</body>
</html>

<?php //}?>