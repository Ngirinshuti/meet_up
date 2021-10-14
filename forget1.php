<?php 
if (isset($_POST['sub'])) {
	$email=$_POST['email'];
	$a=0;
	include("connect.php");
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
	$selector=bin2hex(random_bytes(8));
	$token=random_bytes(32);
	$validator=bin2hex($token);
	$url="http://localhost/web_security/createnewpass.php?selector=".$selector;
	$expires=date("U")+1800;
	
     $sql="delete from pwdreset where email=?";
     $stmt= mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt,$sql)) {
 echo "statement failed";
}
else{
  mysqli_stmt_bind_param($stmt,"s",$email);
  mysqli_stmt_execute($stmt);
}
$q="insert into pwdreset(email,reset,token,expires) values(?,?,?,?)";
$stmt= mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt,$q)) {
 echo "statement failed";
}
else{
	$hashedtoken=password_hash($token,PASSWORD_DEFAULT);
  mysqli_stmt_bind_param($stmt,"ssss",$email,$selector,$hashedtoken,$expires);
  mysqli_stmt_execute($stmt);
}
//mysqli_stmt_close($stmt);
$from = 'prudentenz001@gmail.com';
$to = $email;
$subject = 'Reset password';
$message = '<p>Here is the link you need to follow';
$message .= '<a href="'.$url.'</a></p>';
$headers = 'From: ' . $from;
$headers .= 'Reply-To: ' . $from;
$headers .= 'Content-type:text/html';
mail($to, $subject, $message, $headers);
header("location:recover.php?reset=success");
}
else{
	header("location:recover.php?found=success");
}
}
?>