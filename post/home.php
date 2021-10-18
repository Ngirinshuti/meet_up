<?php require '../classes/init.php';
if (!isset($_SESSION["a_user"])) {
    header("location: ../friends/profile.php");
    exit;
}

$error = "";

$user = $_SESSION["a_user"];

if (isset($_GET['message'])) {
    if ($_GET['message'] == 'empty') {
        echo "Post is not submitted because you tried to send an empty post!";
    }
}
if (isset($_POST['post']) && $_SERVER['REQUEST_METHOD'] === "POST") {
    $user_obj = new User($db_connection, $user);
    $texts = $_POST['text'];
    $dates = date('y/m/d H:i:s');
    $posting = $user_obj->create_post($texts, $dates, $user);
    if ($posting === true) {
        header("location: ./home.php");
    }
    if (isset($posting['Error'])) {
        $error = "<i style='color:green;font-size:25px;'>Post is not submitted because the submitted post was empty!</i>";
    }
}



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Home Page</title>
    <link rel="stylesheet" href="../css/font-awesome-4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="./css/home.css">
    <?php require_once '../theme.php'; ?>
    <title>MeetUp MeetUs</title>
</head>

<body>
    <div class="container">
        <?php require '../menu/menu.php'; ?>
        <form class="postForm formContainer" method="post" enctype="multipart/form-data">
            <div class="desc">
                <label for="area">Any words <?php echo $me ? "'{$me?->username}'" : ""; ?>?</label>
                <textarea id="area" placeholder="Write to share with friends (:" name="text"></textarea>
            </div>
            <div class="filesWrapper">
                <label for="image">Add Image</label>
                <input data-image-input accept="image/*" id="image" name="image" type="file" title="Picture" />
                <label for="video">Add Video</label>
                <input data-video-input accept="video/*" id="video" type="file" name="video" title="Video">
            </div>
            <button type="submit" name="post" style="display: inline-block;max-width:max-content;">Post Now</button>
        </form>
        <hr>
        <div>
            <?php
            if (!$error) {
                $user_obj->select_post();
            } else {
                echo "<div>$error</div>";
            }
            ?>
        </div>
    </div>
    <script defer>
        window.addEventListener("DOMContentLoaded", e => {
            const imageInput = document.querySelector("[data-image-input]")
            const videoInput = document.querySelector("[data-video-input]")

            if (!videoInput || !imageInput) {
                return alert("Something is wrong!");
            }

            videoInput.addEventListener("change", e => {
                const vidElement = document.createElement("video")
                if (videoInput.files[0] && !vidElement.canPlayType(videoInput.files[0].type)) {
                    alert("Video file type not supported!")
                    // videoInput.setAttribute('value', '');
                    return videoInput.form.reset();
                }
                if (videoInput.files[0] && videoInput.files[0].size >= 41943040) {
                    alert("Choosen file is bigger than " + Math.round(41943040/1000000) + "MB");
                    return videoInput.form.reset();
                }
            })

            imageInput.addEventListener("change", e => {
                if (imageInput.files[0] && !(imageInput.files[0].type.startsWith("image/"))) {
                    alert("Image file type not supported!")
                    // videoInput.setAttribute('value', '');
                    return videoInput.form.reset();
                }
            })
        })
    </script>
</body>

</html>