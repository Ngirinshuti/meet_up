<?php 
if (isset($_POST['reset_submit'])) {
	$selector=$_POST['selector'];
  $a=0;
	//$validator=$_POST['validator'];
	$password=$_POST['pwd'];
	$passwordrepeat=$_POST['pwd_repeat'];
	if (empty($password) || empty($passwordrepeat)) {
		header("location:createnewpass.php");
		
	}
	else if ($password!=$passwordrepeat) {
    echo '<script language="javascript">';
echo 'alert("Password are not matching.... try again!!!");';
echo "\n";
  //  echo ' window.location.href="https://www.sustainablewestonma.org/update.php"';
//echo 'window.location.href="createnewpass.php?selector="'.$selector;
header("location:createnewpass.php?selector=$selector&newpwd=pwdnotsame");
echo '</script>';

exit();
  // header("location:createnewpass.php?selector=".$selector);
	//	header("location:createnewpass.php?newpwd=pwdnotsame");
	}
	//$currentdate=date("U");
	require "connect.php";
$sql="select* from pwdreset where reset=?";
$stmt= mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt,$sql)) {
 echo "statement failed";
}
else{
  mysqli_stmt_bind_param($stmt,"s",$selector);
  mysqli_stmt_execute($stmt);
  $select=mysqli_stmt_get_result($stmt);
  while($row=mysqli_fetch_assoc($select)) {
    if($row['reset']==$selector)
    {
    $a=$a+1;
    $tokenemail=$row['email'];
}
  }
  if ($a<1) {
 echo "you need to re-submit your request";
  }
  else
  {
$sql="select* from pwdreset where email=?";
$stmt= mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt,$sql)) {
 echo "statement failed";
}
else{
  mysqli_stmt_bind_param($stmt,"s",$tokenemail);
  mysqli_stmt_execute($stmt);
  $select=mysqli_stmt_get_result($stmt);
  if (!$row=mysqli_fetch_assoc($select)) {
  	echo "There is an error!";
  }
  else
  {
  $sql="UPDATE account set password=? where email=?";
  $stmt= mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt,$sql)) {
 echo "statement failed";
}
else{
  $salted="salting_string@12345".$passwordrepeat;
	$newpwdhash=sha1($salted);
  mysqli_stmt_bind_param($stmt,"ss",$newpwdhash,$tokenemail);
  mysqli_stmt_execute($stmt);

  $sql="delete from pwdreset where email=?";
     $stmt= mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt,$sql)) {
 echo "statement failed";
}
else{
  mysqli_stmt_bind_param($stmt,"s",$tokenemail);
  mysqli_stmt_execute($stmt);
  header("location:index.php?newpwd=passwordupdated");
}	
  }

  	}
}
}}}
else
{
	header("location:index.php");
}
?>