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
  <title>Reset password</title>
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
  width: 50%;
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
          
            <h1 style="margin-left:10cm;">RESET PASSWORD</h1>
            <?php 
$selector=$_GET['selector'];
//$validator=$_GET['validator'];
if (empty($selector)) {
echo "could not validate your request";
}
else
{
  if (ctype_xdigit($selector)!== false/* && ctype_xdigit($validator)!==false*/) {
    ?>
    <form action="reset_password.php" method="post" style="margin-left: 5cm;background-color: whitesmoke;text-align: center;width: 20cm;height: 10cm;"><br><br>
      <input type="hidden" name="selector" value="<?php echo $selector;?>">
     <!-- <input type="hidden" name="validator" value="<?php// echo $validator;?>">-->
     <input class="input-field" type="password" placeholder="Type your new password..........." name="pwd" required="" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$" title="Must contain at least:one number,one lowercase,one uppercase ,one special characher and minimum length is 8, maximum length is 16"><br><br>
      <input class="input-field" type="password" name="pwd_repeat" placeholder="Re-type new password............"><br><br><input type="submit" name="reset_submit" value="Create new password" style="background-color: dodgerblue;height: 1cm;width: 4cm;"><br>

    <?php 
    if (isset($_GET['newpwd'])) {
  if ($_GET['newpwd']=="pwdnotsame") {
   echo "<p class='signupsuccess' style=''>Password is not matching... Try again please!</p>";
  }
}
  }
}
             ?>
               </form>
        </div>
    <br>
        
  <!--<input type="submit" value="Login" onclick="lsRememberMe()">-->
      </div>
    </div>
  </div>
</body>
</html>

<?php }?>