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
?>
<?php
if (isset($_SESSION["a_user"])) {
//$_SESSION["a_user"]=$_COOKIE['name'];
  //require 'friends/profile.php';
   header("location:friends\profile.php");

}
else
{
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/font-awesome-4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <?php //require 'theme.php'; ?>
</head>

<body class="w3-theme-l2">
  <div class="formContainer">
     <h1 class="header">MeetUp</h1>
     <p class="formText">MeetUp MeetUs</p>
    <form action="login.php" method="post"><br>
      <label for="username">E-mail or username</label>
      <input id="username" type="text" name="username" placeholder="Enter e-mail or username" required="" value="<?php if(isset($_COOKIE['name'])){echo $_COOKIE['name'];} ?>"><br>
      <label for="password">Password</label><br>
      <div class="pwd">
        <input id="password" type="password" name="password" placeholder="Enter password" required value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password'];} ?>"></div><div class="visible">
        <i id="visible" onclick="showHide(this.id)" class='fa fa-eye'></i>
      </div><br>
      <div class="checkbox">
        <input style="margin-left: -7.3cm;height: 0.5cm;" type="checkbox" value="lsRememberMe" name="remember" <?php if(isset($_COOKIE['check'])){echo 'checked';} ?>><label for="rememberMe"><p style="margin-left: 1cm;margin-top: -0.8cm; font-size: 22px;" >Remember me</p></label></div><div>
              <input type="hidden" name="<?= $token_id; ?>" value="<?= $token_value; ?>" />
            </div><br>
      <div class="btm">
        <button type="submit" name="login" >Login</button><label class="formText" style=""><br><a href="recover.php" style="margin-left:5.2cm;" class="formLink">Forget password?</a></label><br>
        <!--<input type="submit"  value="Login" /></div><div>-->
        <p id="signup" class="formText"><span>
            <span>Have no account? </span>
            <a href="signup.php" class="formLink">Signup</a>
          </span>
        </p>
      </div>
    
 <?php if (isset($_GET['newpwd'])) {
  if ($_GET['newpwd']=="passwordupdated") {
   echo "<p class='signupsuccess'>your password has been reset!</p>";
  }
}else if (isset($_GET['new'])) {
  if ($_GET['new']=="incorrect") {
   echo "<p class='signupsuccess' style=''>Username or password is incorrect, try again!!</p>";
  }
}
else if (isset($_GET['verfied'])) {
  if ($_GET['verfied']=="notverfied") {
   echo "<p class='signupsuccess'>Account is not verfied ";
   echo "<a href='verified.php'>Verify Now</a></p>";
  }
}
else if (isset($_GET['ver'])) {
  if ($_GET['ver']=="try") {
   echo "<p class='signupsuccess'>Your account is verfied</p>";
  }
}
            ?>
    <?php if (isset($_GET["Error"])) { ?>
      <p id="error"><?php echo $_GET["Error"]; ?></p>
    <?php }
    if (isset($_GET["Success"])) { ?>
      <p id="success"><?php echo $_GET["Success"]; ?></p>
    <?php } ?></form>
  </div>
</body>
<script>
  function showHide(id) {
    var element = document.getElementById(id);
    var passwordElement = document.getElementsByName("password")[0];
    element.classList.toggle("fa-eye-slash");
    if (passwordElement.type == "password") {
      passwordElement.type = "text";
    } else {
      passwordElement.type = "password";
    }
  }
</script>

</html>
<?php }?>




