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
  <title>Verify account</title>
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
          <form method="post" action="confirm.php" style="margin-left: 5cm;background-color: whitesmoke;text-align: center;width: 20cm;height: 10cm;">
            <h1 style="margin-left:0cm;">ACCOUNT VERIFICATION</h1>
            <section></section>
           <div class="input-group mb-3">
             
            <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Type your verification code here........ " name="code" required="">
  </div>
  
            <div class="form-group">
              <input type="hidden" name="<?= $token_id; ?>" value="<?= $token_value; ?>" />
            </div><br>
              <div class="d-flex justify-content-center mt-3 login_container" style="margin-top">

          <input type="submit" name="sub" value="Verify" class="btn" style="background-color: dodgerblue;height: 1cm;width: 4cm;" ><br><br>
          I already have an account click <a href="index.php">here</a> to login
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