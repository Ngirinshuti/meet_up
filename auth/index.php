<?php
// user login script 

session_start();

require "./Auth.php";
require "../forms/Validator.php";

$validator = new Validator();
list($errors, $data, $errorClass, $mainError, $msg) = $validator->helpers();

$shouldVerify = false;

$validator->methodPost(
    function (Validator $validator) {
        $validator->addRules(
            [
                "username" => ["not_empty" => true],
                "password" => ["not_empty" => true],
                "remember_me" => []
            ]
        )->addData($_POST)->validate();

        if ($validator->valid) {
            try {
                $user = Auth::login(...$validator->valid_data);
                if ($user) {
                    if (!$user->verified) {
                        header("Location: ./verify_email.php?msg=Please verify email first");
                        exit();
                    }

                    // set cookies
                    if ($validator->valid_data["remember_me"]) {
                        Auth::remember($user->username);
                    }

                    Auth::authenticate($user);

                    // $validator->setSuccessMsg("You have logged in!");
                }
            } catch (AuthException $e) {
                $validator->setMainError($e->getMessage());
            }
        }
    }
);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="./css/auth.css">
    <title>Login</title>
</head>

<body>
    <div class="authFormContainer">

        <form action="" method="post" class="authForm">
            <div class="formHeader">
                <a href="#!" class="formBrand">MeetUp</a>
                <h2>Login</h2>
            </div>
            <?php echo $msg(); ?>
            <?php echo $mainError(); ?>
            <div class="formBody">

                <div class="authInput <?php echo $errorClass('username'); ?>">
                    <Label for="login_username">Username</Label>
                    <input value="<?php echo $data("username"); ?>" name="username" placeholder="Type username.." type="text" id="login_username" />
                    <?php echo $errors('username'); ?>
                </div>
                <div class="authInput  <?php echo $errorClass('password'); ?>">
                    <label for="login_password">Password</label>
                    <input name="password" placeholder="Type password.." type="password" id="login_password" />
                    <?php echo $errors('password'); ?>
                </div>
                <div class="authInput  <?php echo $errorClass('remember_me'); ?>">
                    <input name="remember_me" type="checkbox" id="login_remember_me" />
                    <label for="login_remember_me">Remember me</label>
                    <?php echo $errors('remember_me'); ?>
                </div>

            </div>
            <p class="formText">Don't have account? <a href="./signup.php" class="formLink">signup</a></p>
            <button>Login</button>
        </form>
    </div>
    <script defer>
    </script>
</body>

</html>