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
                "post" => ["required_without" => ["image", "video"]],
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
    <link rel="stylesheet" href="<?php echo getUrl("/post/css/home.css");  ?>">
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
                    <textarea autofocus name="post" class=" <?php echo $errorClass('post'); ?>" id="area" placeholder="Write to share with friends (:"><?php echo $data('post'); ?></textarea>
                    <?php echo $errors('post'); ?>
                </div>
                <div class="filesWrapper">
                    <label for="image">Add Image</label>
                    <input data-tooltip="Post an image" class=" <?php echo $errorClass('image'); ?>" data-image-input accept="image/*" id="image" name="image" type="file" title="Picture" />
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
                        <button class="postLike <?php echo $post->likedBy($me->username) ? "liked" : ""; ?> likeBtn">
                        <?php echo $post->likedBy($me->username) ? "UnLike" : "Like"; ?>
                        <span class="likeNum"> <?php echo $post->likes(); ?></span></button>
                    </form>
                        <button data-comment-toggle class="cmtBtn">Comment</button>
                    </div>
                    
                    <div data-current-user="<?php echo $me->username; ?>" data-post-id="<?php echo $post->id; ?>" class="commentContainer hide">
                        <label for="user-comment">Comment</label>
                        <form data-comment-form class="commentForm">
                            <?php echo $validator->getCsrfField()(); ?>
                            <input type="hidden" name="username" value="<?php echo $me->username; ?>">
                            <input type="hidden" name="post_id" value="<?php echo $post->id; ?>">
                            <textarea autofocus name="comment" id="user-comment" placeholder="comment here.." data-comment-area></textarea>
                            <button data-comment-btn>Post</button>
                        </form>
                        <div class="commentList">
                            
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- comment template -->
        <template data-comment-template>
            <div class="comment">
                <div class="commentUserImg">
                    <img src="<?php echo getUrl("/images/{$me->profile_pic}");  ?>" alt="comment">
                </div>
                <div class="commentContent">
                    <span class="commentUserName"><?php echo $me->username; ?></span>
                    <div class="commentBody">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, eius.</div>
                    <div class="commentBtns">
                        <button class="commentBtn likeBtn" data-comment-like>Like 1</button>
                    </div>
                </div>
            </div>
        </template>
        <!-- comment template -->


    <script src="<?php echo getUrl("/post/js/comments.js");  ?>" defer></script>
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