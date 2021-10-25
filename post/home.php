<?php
// home feed file

require_once __DIR__ .  '/../classes/init.php';
require_once __DIR__ . "/./Post.php";
require_once __DIR__ . "/../forms/Validator.php";

$user = $me;


// friend posts array

$validator = new Validator();
list($errors, $data, $errorClass, $mainError, $msg, $csrf) = $validator->helpers();

$validator = new Validator();
list($errors, $data, $errorClass, $mainError) = $validator->helpers();

$validator->methodPost(
    function (Validator $validator) {
        $validator->addRules(
            [
                "post" => ["not_empty" => true, "min_length" => 5],
                "image" => ['is_file' => __DIR__ . "/images"],
                "video" => ['is_file' => __DIR__ . "/videos"],
                "username" => []
            ]
        )->addData($_POST)->validate();

        if ($validator->valid) {
            try {
                $post = Post::create(...$validator->valid_data);

                if (!$post) {
                    return new FormError("Something, went wrong! try again later ):");
                }

                header("Location: ./home.php?msg=Post crearted!");
                exit();
            } catch (FormError $e) {
                $validator->setMainError($e->getMessage());
            }
        }
    }
);

$posts = Post::getFriendsPosts($user->username);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="../css/font-awesome-4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="./css/home.css">
    <?php require_once '../theme.php'; ?>
    <title>MeetUp MeetUs</title>
</head>

<body>
    <div class="container">
        <?php require '../menu/menu.php'; ?>
        <div class="postFormContainer">
            <?php echo $msg(); ?>
            <form action="" class="postForm formContainer" method="post" enctype="multipart/form-data">
                <?php echo $csrf(); ?>
                <input type="hidden" name="username" value="<?php echo $me->username; ?>">
                <div class="desc mainInput">
                    <label for="area">Any words <?php echo $me ? "'{$me?->username}'" : ""; ?>?</label>
                    <textarea name="post" class=" <?php echo $errorClass('post'); ?>" id="area" placeholder="Write to share with friends (:"><?php echo $data('post'); ?></textarea>
                    <?php echo $errors('post'); ?>
                </div>
                <div class="filesWrapper">
                    <label for="image">Add Image</label>
                    <input class=" <?php echo $errorClass('image'); ?>" data-image-input accept="image/*" id="image" name="image" type="file" title="Picture" />
                    <?php echo $errors('image'); ?>
                    <label for="video">Add Video</label>
                    <input class=" <?php echo $errorClass('video'); ?>" data-video-input accept="video/*" id="video" type="file" name="video" title="Video">
                    <?php echo $errors('video'); ?>
                </div>
                <button type="submit" style="display: inline-block;max-width:max-content;">Post Now</button>
            </form>
        </div>
        <div class="postContainer">
            <?php foreach ($posts as $post) : ?>
                <div class="userpost"  id="post<?php echo $post->id; ?>">
                    <div class="postHeader">
                        <div class="postUser">
                            <div class="userProfile">
                                <img src="../images/<?php echo $post->owner()->profile_pic; ?>" />
                            </div>
                            <div class="userName"><?php echo $post->username; ?></div>
                        </div>
                    </div>
                    <div class="postBody">
                        <?php if ($post->post) : ?>
                            <div class="postText">
                                <?php echo $post->post; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($post->image && !$post->video) : ?>
                            <img class="postImg" src="./images/<?php echo $post->image; ?>" />
                            <?php endif; ?>
                        <?php if ($post->video) : ?>
                            <video class="postVideo" src="./videos/<?php echo $post->video; ?>" controls>
                            <?php endif; ?>
                    </div>
                    <div class="postFooter">
                        <form action="like_post.php" method="post">
                            <input type="hidden" name="post_id" value="<?php echo $post->id; ?>">
                            <input type="hidden" name="username" value="<?php echo $post->username; ?>">
                        <button class="likeBtn">Like <?php echo $post->likes(); ?></button>
                    </form>
                        <button class="cmtBtn">Comment</button>
                    </div>
                </div>
            <?php endforeach; ?>
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
                    alert("Choosen file is bigger than " + Math.round(41943040 / 1000000) + "MB");
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