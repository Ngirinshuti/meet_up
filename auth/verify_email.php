<?php
// user email verify script 

session_start();

require "./Auth.php";
require "../forms/Validator.php";

$validator = new Validator();
list($errors, $data, $errorClass, $mainError, $msg) = $validator->helpers();

// resend email if necessary
if (isset($_GET['resend']) && intval($_GET['resend']) != intval($_SESSION['resend'])) {
    $_SESSION['resend'] = intval($_GET['resend']);
    $email = $_SESSION['verify_email'];
    Auth::sendVerficationCode(User::findOne(email: $email));
    $validator->setSuccessMsg("Email sent!");
}

if (!isset($_GET['resend'])) {
    $_SESSION['resend'] = 0;
}

$validator->methodPost(
    function (Validator $validator) {
        $validator->addRules(
            [
                "email" => [],
                "verification_code" => ["not_empty" => true, "is_number" => true],
            ]
        )->addData($_POST)->validate();

        if ($validator->valid) {
            try {
                if (Auth::verifyEmail(...$validator->valid_data)) {
                    $validator->setSuccessMsg("Email was successfully verfied (:");
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
    <title>Verify</title>
</head>

<body>
    <div class="authFormContainer">


        <form action="" method="post" class="authForm">
            <div class="formHeader">
                <a href="#!" class="formBrand">MeetUp</a>
                <h2>Verify Email</h2>
            </div>
            <?php echo isset($_GET['msg']) ? "<div class='formMsg'>{$_GET['msg']}</div>" : ""; ?>
            <?php echo $msg(); ?>
            <?php echo $mainError(); ?>
            <div class="formBody">
                <input type="hidden" name="email" value="<?php echo isset($_SESSION['verify_email']) ? $_SESSION['verify_email'] : ""; ?>" />
                <div class="authInput <?php echo $errorClass('verification_code'); ?>">
                    <Label for="verification_code">Verification code</Label>
                    <input value="<?php echo $data("verification_code"); ?>" name="verification_code" placeholder="Type verification code.." type="text" id="verification_code" />
                    <?php echo $errors('verification_code'); ?>
                </div>
            </div>
            <p class="formText">Didn't recieve code?
                <a href="verify_email.php?resend=<?php echo intval($_SESSION["resend"]) + 1; ?>" class="formLink">resend</a>
            </p>
            <button>Verify</button>
            <a href="./index.php" class="btn">Go to login</a>
        </form>

    </div>
    <script defer>
    </script>
</body>

</html>