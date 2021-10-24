<?php


require __DIR__ .  '/../classes/init.php';
require __DIR__ . "/./Post.php";

$user = $me;

// friend posts array

$posts = Post::getFriendsPosts($user->username);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/home.css">
    <title>Document</title>
</head>

<body>
    <div class="postContainer">
        <?php foreach ($posts as $post) : ?>
            <div class="userpost">
                <div class="postHeader">
                    <div class="postUser">
                        <div class="userName"><?php echo $post->username; ?></div>
                    </div>
                </div>
                <div class="postBody">
                    <?php echo $post->post; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>