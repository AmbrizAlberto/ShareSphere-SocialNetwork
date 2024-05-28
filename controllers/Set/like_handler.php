<?php
// like_handler.php
namespace controllers;

session_start();
require_once("../../autoload.php");
use Models\posts;

if (empty($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$postsModel = new posts();
$userId = $_SESSION['userId'];
$postId = $_POST['postId'];
$Id = filter_var($postId, FILTER_SANITIZE_NUMBER_INT);
$userName = $_SESSION['username']; // Usamos el nombre de usuario de la sesión

try {
    if ($postsModel->UserLikedPost($postId, $userId)) {
        $postsModel->RemoveLike($postId, $userId); // Unlike if already liked
        $likeStatus = -1; // Indicate that the like has been removed

        // Remove the related notification
        $postsModel->RemoveNotification($postId, $userId);
    } else {
        $postsModel->AddLike($postId, $userId); // Like the post
        $likeStatus = 1; // Indicate that a new like has been added

        // Get the ID of the user who posted the post
        $authorId = $postsModel->GetPostById($postId)['creatorId'];

        // Register the notification
        // Obtener el título de la publicación usando su ID
        $postInfo = $postsModel->GetPostById($postId);
        $postTitle = $postInfo['title'];

        // Construir el contenido de la notificación con el nombre del usuario que ha dado like y el título de la publicación
        $notificationContent = 'El usuario ' . $userName . ' ha dado like a tu publicación "' . $postTitle . '"';
        $postsModel->InsertNotification($authorId, $userId, $Id);
    }

    // Get the new like count
    $likeCount = $postsModel->GetLikesCount($postId);

    // Send response
    echo json_encode(['status' => 'success', 'likeStatus' => $likeStatus, 'likeCount' => $likeCount]);
} catch (Exception $e) {
    // Handle errors gracefully
    console_log($e->getMessage());
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
