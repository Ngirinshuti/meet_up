<?php 
session_start();
$name=$_SESSION['name'];
$pwd=$_SESSION['pass'];
?>
<?php 
$fname=$_POST['fname'];
$lname=$_POST['lname'];
 $user=$_POST['user'];
 $email=$_POST['email'];
  $pwd=$_POST['pwd'];
 $salted="salting_string@12345".$pwd;
 $hashed_pass = sha1($salted);
 $cpwd=$_POST['cpwd'];
$re=0;
 if ($pwd!=$cpwd) {
 	echo "<script>alert('Password is not matching... Try again please!')</script>";
 	include "createaccount.php";
 }
 else
 {
  include "connect.php";
         $sql="select email from account where email=?";
         $stmt= mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt,$sql)) {
 echo "statement failed";
}
else{
  mysqli_stmt_bind_param($stmt,"s",$email);
  mysqli_stmt_execute($stmt);
  $emi=mysqli_stmt_get_result($stmt);
while ($feti=mysqli_fetch_array($emi)) {
   if ($email==$feti['email']) {
       $re=1;

   }
}
}
}
if($re!=1)
{
    if($user!=$pwd and $email!=$pwd)
    {
        $ran=mt_rand(100000,999999);
        $status='not verified';
$q="insert into account(fname,lname,email,username,password,activation,status) values(?,?,?,?,?,?,?)";
$stmt= mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt,$q)) {
 echo "statement failed";
}
else{
  mysqli_stmt_bind_param($stmt,"sssssss",$fname,$lname,$email,$user,$hashed_pass,$ran,$status);
  mysqli_stmt_execute($stmt);
}
  //$select=mysqli_stmt_get_result($stmt);
if ($q) {
   
	 	//echo "<script>alert('Your have created an account! Click ok to login.')</script>";
 	//include "index.php";
         $to = $email;
         $subject = "confirmation code";
         
         $message = $ran;
         
         $header = "From:prudentenz001@gmail.com \r\n";    
         $retval = mail($to,$subject,$message,$header);
         
         if( $retval == true ) {
            $_SESSION['em']=$email;
           header("location:testing.php?conf=sent");
         }else {
            header("location:testing.php?confi=notsent");
         }
}
else{
    echo "<script>alert('Failed to create an account!... Try again please!')</script>";
    include "createaccount.php"; 
}
}
else
{
 echo "<script>alert('Your username or email must differ from you password!... Try again please!')</script>";
    include "createaccount.php";    
}
}
else
{
 echo "<script>alert('This email is used by someone else!... Try to use another email!')</script>";
    include "createaccount.php";   
}
 ?>
