<?php
session_start();
require_once('connect.php');
if (isset($_POST['sub'])) {
 $a=0;
  $email = $conn->real_escape_string($_POST['email']);
  
  $sql="select* from account where email=?";
$stmt= mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt,$sql)) {
 echo "statement failed";
}
else{
  mysqli_stmt_bind_param($stmt,"s",$email);
  mysqli_stmt_execute($stmt);
  $select=mysqli_stmt_get_result($stmt);
  while($row=mysqli_fetch_assoc($select)) {
    if($row['email']==$email)
    {
    $a=$a+1;
    $tokenemail=$row['email'];
}
  }
}
  if($a>=1){

 
$otp= mt_rand(100000, 999999);

    $query = "UPDATE account SET activation=? WHERE email=? ";
  $stmti = $conn->prepare($query);
$stmti->bind_param('is',$otp,$email);
$stmti->execute();
$stmti->close();
    $_SESSION['username'] = $username;
    $_SESSION['pwd'] = $password;
    $_SESSION['em'] = $email;
    $_SESSION['code'] = $otp;
    //$_SESSION['stat'] = $status;
    $to=$email;
    $from="From: prudentenz001@gmail.com";
    $subject="Verification Code";
    $message =$otp;
  
    $mailing = mail($to,$subject,$message,$from);

    header('location: testing.php?message=code');
}
else{
  header('location: verified.php?message=code');
}}
?>