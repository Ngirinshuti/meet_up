<?php 


if (!isset($_POST['username']) || !isset($_POST['post_id'])) {
    header("Location: ./home.php");
    exit;
}

require "./Post.php";

$post = Post::findOne((int)$_POST['post_id']);
$post->like($_POST['username']);

header("Location: ./home.php#post".$_POST['post_id']);
