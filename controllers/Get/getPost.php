<?php
namespace controllers;

require_once ("../../autoload.php");
use Models\posts;

$post = new posts();
$request = $post->GetPostsForJson();
header('Content-Type: application/json');
echo json_encode($request);
?>