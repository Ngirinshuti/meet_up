<?php

include 'token.php';
 
$csrf = new csrf();
 
// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);
if($csrf->check_valid('post')) {
  var_dump($_POST[$token_id]);
} 
?>
<?php
session_start();
require 'classes/user.php';
  require 'classes/db.php';
  $db_obj        = new Con('localhost', 'root', 'project2', '');
  $db_connection = $db_obj->create_connection();
   //$email=$_GET['email'];
if (isset($_POST['sub'])) {
$email=$_POST["email"];
$user_obj = new User($db_connection,$email);
      $reset = $user_obj->reset_password($email);

}
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
  <title>Forget password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=devive-width,initial-scale=1.0">

<link rel="stylesheet" href="css/style.css">
</head>
<body >
  <div class="formContainer">
    <h1 class="header">MeetUp</h1>
        <p ><h3 class="formText">MeetUp MeetThem</h3></p>
          <form method="post">
            <h1 class="formText">FORGET PASSWORD</h1>
            <section></section>
           <div class="input-group mb-3">
             
            <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="email" placeholder="Type your email here........ " name="email" required="">
  </div>
  
            <div class="form-group">
              <input type="hidden" name="<?= $token_id; ?>" value="<?= $token_value; ?>" />
            </div><br>
              <div class="d-flex justify-content-center mt-3 login_container" style="margin-top">
<button name="sub" type="submit">Reset my password</button>
    <br><br><p class="formText">
          I have MeetUp account.<a href="index.php" class="formLink">Login</a> now!</p>
           </div>
          </form><br><p class="formText">
          <?php
if (isset($_GET['reset'])) {
  if ($_GET['reset']=="success") {
   echo "<p class='signupsuccess' style=''>check your e-mail to reset your password!</p>";
  }
}else if (isset($_GET['found'])) {
  if ($_GET['found']=="success") {
   echo "<p class='signupsuccess' style=''>your email does not found in database!</p>";
  }
}
            ?></p>
        </div>
    <br>
</body>
</html>

<?php //}?>