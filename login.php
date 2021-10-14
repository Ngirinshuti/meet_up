<?php 
session_start();
if (!isset($_SESSION['pass'],$_SESSION['name'])) {
  header("location:index.php");
}
$name=$_SESSION['name'];
$pwd=$_SESSION['pass'];
?>
<?php
session_start();
$name=$_POST['usern'];
$pwd=$_POST['pass'];
$salted="salting_string@12345".$pwd;
 $pass = sha1($salted);
$x=0;
$y=0;
include("connect.php");
$sql="select* from account where username=? and password=?";
$stmt= mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt,$sql)) {
 echo "statement failed";
}
else{
  mysqli_stmt_bind_param($stmt,"ss",$name,$pass);
  mysqli_stmt_execute($stmt);
  $select=mysqli_stmt_get_result($stmt);
while($user=mysqli_fetch_array($select))
{
if(($name==$user['username'])&&($pass==$user['password']))
{
 
 $fst=$user['username'];
  $eml=$user['email'];
  $x=1;
  $_SESSION['name']=$name;
  $_SESSION['pass']=$pwd;
  $status=$user['status'];

}
}
}
if($x==1)
{
   if ($status=='Verified') {
  if (!empty($_POST['remember'])) {
$check=$_POST['remember'];
   setcookie("name",$name,time()+3600*24*7);
   setcookie("password",$pwd,time()+3600*24*7);
   setcookie("check",$check,time()+3600*24*7);
  }
  else{
$check=0;
     setcookie("name",$name,7);
       setcookie("password",$pwd,7);
         setcookie("check",$check,7);
  }
header("location:dashboard.php");
}
else{
  header("location:index.php?verfied=notverfied");
}
}
else{
  header("location:index.php?new=incorrect");
}

?>
