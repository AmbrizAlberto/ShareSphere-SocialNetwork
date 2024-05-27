<?php
namespace controllers;

require_once ("../../autoload.php");
use Models\posts;

// Obtener las publicaciones
$post = new posts();
$posts = $post->GetPostsForJson();

// Devolver las publicaciones en formato JSON
header('Content-Type: application/json');
echo json_encode($posts);
?>
