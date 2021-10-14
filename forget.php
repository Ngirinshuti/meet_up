<?php 
include("connect.php");
$email='prudentenri001@gmail.com';
$x=0;
$sql="select* from account where email=?";
$stmt= mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt,$sql)) {
 echo "statement failed";
}
else{
  mysqli_stmt_bind_param($stmt,"s",$email);
  mysqli_stmt_execute($stmt);
  $select=mysqli_stmt_get_result($stmt);
while($user=mysqli_fetch_array($select))
{
	if ($email==$user['email']) {
		$x=1;
	}
}}
if ($x==1) 
{
	/*use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;*/

/* Include the Composer generated autoload.php file. */
require 'C:\xampp\htdocs\web_security\composer\vendor\autoload.php';

/* If you installed PHPMailer without Composer do this instead: */

require 'C:\xampp\htdocs\web_security\PHPMailer\src\Exception.php';
require 'C:\xampp\htdocs\web_security\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\web_security\PHPMailer\src\SMTP.php';

/* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
$mail = new PHPMailer(TRUE);

/* Open the try/catch block. */
try {
   /* Set the mail sender. */
   $mail->setFrom('prudentenz001@gmail.com', 'Ngirinshuti');

   /* Add a recipient. */
   $mail->addAddress($email, 'Emperor');

   /* Set the subject. */
   $mail->Subject = 'Testing';

   /* Set the mail message body. */
   $mail->Body = 'There is a great disturbance in the Force.';

   /* Finally send the mail. */
   $mail->send();
}
catch (Exception $e)
{
   /* PHPMailer exception. */
   echo $e->errorMessage();
}
catch (\Exception $e)
{
   /* PHP exception (note the backslash to select the global namespace Exception class). */
   echo $e->getMessage();
}
}
else
{
	echo "email not found";
}
?>