<?php
// user email verify script 
require_once __DIR__ . "/./unauthenticate.php";
require_once __DIR__ . "/./Auth.php";
require_once __DIR__ . "/../forms/Validator.php";

$validator = new Validator();
list($errors, $data, $errorClass, $mainError, $msg, $csrf) = $validator->helpers();

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
                    header("Location: ./index.php?msg=Email was successfully verfied (:");
                    // $validator->setSuccessMsg("");
                    exit;
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
    <title>Verify</title>
</head>

<body>
    <div class="mainFormContainer">

        <form action="" method="post" class="mainForm">
            <div class="formHeader">
                <a href="#!" class="formBrand">MeetUp</a>
                <h2>Verify Email</h2>
            </div>
            <?php echo $msg(); ?>
            <?php echo $mainError(); ?>
            <div class="formBody">
                <?php echo $csrf(); ?>
                <input type="hidden" name="email" value="<?php echo isset($_SESSION['verify_email']) ? $_SESSION['verify_email'] : ""; ?>" />
                <div class="mainInput <?php echo $errorClass('verification_code'); ?>">
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