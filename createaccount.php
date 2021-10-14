
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

.input-container {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  width: 100%;
  margin-bottom: 15px;
}

.icon {
  padding: 10px;
  background: dodgerblue;
  color: white;
  min-width: 50px;
  text-align: center;
}

.input-field {
  width: 100%;
  padding: 10px;
  outline: none;
}

.input-field:focus {
  border: 2px solid dodgerblue;
}

/* Set a style for the submit button */
.btn {
  background-color: dodgerblue;
  color: white;
  padding: 15px 20px;
  border: none;
  cursor: pointer;
  width: 30%;
  margin-left: 100px;
}

.btn:hover {
  opacity: 1;
}
</style>
</head>
<body background="npc.png">
<br><br><br><br><br>
<div class="user_card" style="margin-left: 50px;">
<form action="account.php" method="POST" style="max-width:500px;margin:auto;background-color: whitesmoke;">
  <h3>Register Form</h3>
    <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Firstname" name="fname" required="">
  </div>
    <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Lastname" name="lname" required="">
  </div>

  <div class="input-container">
    <i class="fa fa-envelope icon"></i>
    <input class="input-field" type="email" placeholder="Email" name="email" required="">
  </div>
    <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Username" name="user" required="">
  </div>
  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Password" name="pwd" required="" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$" title="Must contain at least:one number,one lowercase,one uppercase, one special characher and minimum length is 8, maximum length is 16">
  </div>
 <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Confirm Password" name="cpwd" required="">
  </div>
  <button type="submit" class="btn">Register</button><br><br>
  <div class="mt-4">
         <div class="d-flex justify-content-center links">
            I already have an account !&nbsp; <a href="index.php" class="ml-2" style="color: blue;text-decoration: none;">Login here</a>
          </div><br>
</form></div>

</body>
</html>
  