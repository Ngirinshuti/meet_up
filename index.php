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
if (isset($_COOKIE['password'],$_COOKIE['name'])) {
  $pwd=$_COOKIE['password'];
  $name=$_COOKIE['name'];
  $_SESSION['name']=$name;
  $_SESSION['pass']=$pwd;
header("location:dashboard.php");
}
else
{
?>

<!DOCTYPE html>
<html>
    
<head>
  <title>Login form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=devive-width,initial-scale=1.0">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

.input-container {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  width: 100%;
  margin-bottom: 15px;
}


.input-field {
  width: 70%;
  padding: 10px;
  outline: none;
  margin-left: 3cm;
}

.input-field:focus {
  border: 2px solid dodgerblue;
}
.signupsuccess{
  color:red;
  font-size:22px;
  background-color:white;
  padding:10px; 
  margin: 15px;
}
/* Set a style for the submit button */

  </style>
</head>
<body style="margin-top: 0cm;margin-left: 0cm;">
  <div class="container h-100">
    <div class="d-flex justify-content-center h-100" >
      <div class="user_card">
        <div class="d-flex justify-content-center form_container">
          <form method="post" action="login.php" style="margin-left: 5cm;background-color: whitesmoke;text-align: center;width: 20cm;height: 12cm;">
            <h1 style="margin-left:0cm;">LOGIN FORM</h1>
            <section></section>
           <div class="input-group mb-3">
             
            <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Type your username " name="usern" required="" value="<?php if(isset($_COOKIE['name'])){echo $_COOKIE['name'];} ?>">
  </div>
  
  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Type your Password" name="pass" required="" value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password'];} ?>">
  </div>
            <div class="form-group">
              <!--<div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customControlInline">
                <label class="custom-control-label" for="customControlInline">Remember me</label>
              </div>-->
              <input type="checkbox" value="lsRememberMe" id="rememberMe" name="remember" <?php if(isset($_COOKIE['check'])){echo 'checked';} ?>> <label for="rememberMe">Remember me</label><br><br>
              <input type="hidden" name="<?= $token_id; ?>" value="<?= $token_value; ?>" />
            </div><br>
              <div class="d-flex justify-content-center mt-3 login_container" style="margin-top">

          <input type="submit" name="sub" value="Login" class="btn" style="background-color: dodgerblue;height: 1cm;width: 4cm;" ><br><br><label>Click this link if you <a href="recover.php" style="">Forget password</a></label><br><br>
          I don't have an account <a href="createaccount.php" style="text-decoration: none;">Signup</a>
           </div>
          </form>
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
   echo "<p class='signupsuccess' style=''>Account is not verfied ";
   echo "<a href='verified.php'>Verify Now</a></p>";
  }
}
else if (isset($_GET['ver'])) {
  if ($_GET['ver']=="try") {
   echo "<p class='signupsuccess' style=''>Your account is verfied</p>";
  }
}
            ?>
        </div>
    <br>
        
  <!--<input type="submit" value="Login" onclick="lsRememberMe()">-->
      </div>
    </div>
  </div>
</body>
</html>

<?php }?>