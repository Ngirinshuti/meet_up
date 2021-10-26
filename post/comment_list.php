<?php 

require_once __DIR__ . "/./comment_api.php";

if (!isset($_GET['post_id'])) {
    $closure = fn () => ["errors" => ["post_id" => ["Post is necessary"]]];
    return sendJson($closure);
}

$page = isset($_GET['page']) ? intval($_GET['page']) : 0;
$length = isset($_GET['page_length']) ? intval($_GET['page_length']) : 5;
$post_id = intval($_GET['post_id']);

return sendJson(fn() => Comment::findByPost($post_id, $page, $length));
