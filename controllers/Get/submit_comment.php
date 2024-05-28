<?php
// submit_comment.php
namespace controllers;

session_start();
require_once("../../autoload.php");
use Models\posts;

if (empty($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$posts = new posts();
$userId = $_SESSION['userId'];
$requestData = json_decode(file_get_contents('php://input'), true);
$postId = filter_var($requestData['postId'], FILTER_SANITIZE_NUMBER_INT);
$newComment = $requestData['comment'];

// Agregar el nuevo comentario a la base de datos
$commentId = $posts->AgregarComentario($postId, $userId, $newComment); // Reemplaza AgregarComentario con el método real

// Obtener el recuento total de comentarios después de agregar el nuevo comentario
$commentCount = $posts->GetCommentsCount($postId); // Reemplaza GetCommentsCount con el método real

// Obtener el id del creador de la publicación
$postData = $posts->GetPostById($postId);
$postOwnerId = $postData['creatorId'];

// Preparar los datos de respuesta
$responseData = array(
    'commentId' => $commentId,
    'commentCount' => $commentCount,
    'currentUserId' => $userId,
    'postOwnerId' => $postOwnerId
);

// Devuelve los datos como JSON
header('Content-Type: application/json');
echo json_encode($responseData);
?>
