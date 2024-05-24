<?php
// like_handler.php
namespace controllers;

session_start();
require_once ("../../autoload.php");
use Models\posts;

if (empty($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$posts = new posts();
$userId = $_SESSION['userId'];
$postId = $_POST['postId'];

if ($posts->UserLikedPost($postId, $userId)) {
    $posts->RemoveLike($postId, $userId); // Si ya ha dado like, quitar el like
    $likeStatus = -1; // Indicar que se ha eliminado el like
} else {
    $posts->AddLike($postId, $userId); // Si no ha dado like, agregar un nuevo like
    $likeStatus = 1; // Indicar que se ha agregado un nuevo like
}

$likeCount = $posts->GetLikesCount($postId); // Obtener el nuevo conteo de likes

echo json_encode(['status' => 'success', 'likeStatus' => $likeStatus, 'likeCount' => $likeCount]);
?>
