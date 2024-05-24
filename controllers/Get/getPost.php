<?php
namespace controllers;

require_once ("../../autoload.php");
use Models\posts;

// Obtener las publicaciones
$post = new posts();
$posts = $post->GetPostsForJson();

// Agregar la cantidad de "likes" a cada publicación
foreach ($posts as &$post) {
    $postId = $post['id'];
    $GetLikesCount = $post['likes']; // Obtener la cantidad de "likes" del array de la publicación
    $post['likes'] = $GetLikesCount;
}

// Devolver las publicaciones en formato JSON
header('Content-Type: application/json');
echo json_encode($posts);
?>
