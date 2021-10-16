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
if (isset($_POST['reset_submit'])) {
$pwd=$_POST["pwd"];
$pwd_repeat=$_POST["pwd_repeat"];
$selector=$_POST["selector"];
$user_obj = new User($db_connection,$pwd);
      $reset = $user_obj->reset_password1($pwd,$pwd_repeat,$selector);

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
  <title>Reset password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=devive-width,initial-scale=1.0">
<link rel="stylesheet" href="css/style.css">
</head>
<body >
  <div class="formContainer">
    <h1 class="header">MeetUp</h1>
        <p ><h3 class="formText">MeetUp MeetThem</h3></p>
          
            
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
    <form method="post">
      <h1 class="formText">RESET PASSWORD</h1>
      <input type="hidden" name="selector" value="<?php echo $selector;?>">
     <!-- <input type="hidden" name="validator" value="<?php// echo $validator;?>">-->
     <input class="input-field" type="password" placeholder="Type your new password..........." name="pwd" required="" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$" title="Must contain at least:one number,one lowercase,one uppercase ,one special characher and minimum length is 8, maximum length is 16"><br><br>
      <input class="input-field" type="password" name="pwd_repeat" placeholder="Re-type new password............"><br><br>
<button name="reset_submit" type="submit">Create new password</button>
      <br>

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
</body>
</html>

<?php// }?>