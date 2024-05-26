<?php
// submit_comment.php
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
$requestData = json_decode(file_get_contents('php://input'), true);
$postId = $requestData['postId'];
$newComment = $requestData['comment'];

// Agregar el nuevo comentario a la base de datos
$commentId = $posts->AgregarComentario($postId, $userId, $newComment); // Reemplaza AgregarComentario con el método real

// Obtener el recuento total de comentarios después de agregar el nuevo comentario
$commentCount = $posts->GetCommentsCount($postId); // Reemplaza GetCommentsCount con el método real

$responseData = array(
    'commentId' => $commentId,
    'commentCount' => $commentCount
);

// Devuelve los datos como JSON
header('Content-Type: application/json');
echo json_encode($responseData);

?>
