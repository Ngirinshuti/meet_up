<?php 

if (!isset($_POST['username']) || !isset($_POST['post_id'])) {
    header("Location: ./home.php");
    exit;
}

require_once "./Post.php";

$post = Post::findOne((int) $_POST['post_id']);

$username = $_POST['username'];

if ($post->likedBy($username)) {
    $post->unlike($username);
} else {
    $post->like($username);
}


header("Location: ./home.php#post".$_POST['post_id']);
