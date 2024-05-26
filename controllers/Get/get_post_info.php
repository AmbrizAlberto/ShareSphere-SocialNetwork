<?php
// get_post_info.php
namespace controllers;

session_start();
require_once ("../../autoload.php");
use Models\posts;

if (empty($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$posts = new posts();
$postId = $_GET['postId'];

// Obtener la información de la publicación por su ID
$postData = $posts->GetPostById($postId);

// Verificar si se obtuvo la información de la publicación
if (!$postData) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to fetch post data']);
    exit();
}

// Obtener la información del creador de la publicación
$creatorData = $posts->GetUserById($postData['creatorId']);
if (!$creatorData) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to fetch creator data']);
    exit();
}

// Obtener los comentarios asociados a la publicación por su ID
$commentsData = $posts->GetComments($postId);

// Verificar si se obtuvieron los datos de los comentarios
if ($commentsData === false) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to fetch comments']);
    exit();
}

// Obtener los datos del usuario asociado a cada comentario
foreach ($commentsData as &$comment) {
    $userData = $posts->GetUserById($comment['user_id']);
    if ($userData) {
        // Agregar los datos del usuario al comentario
        $comment['user'] = [
            'username' => $userData['username'],
            'image' => $userData['image']
        ];
    } else {
        // Si no se encuentra el usuario, proporcionar un nombre y una imagen por defecto
        $comment['user'] = [
            'username' => 'Usuario desconocido',
            'image' => 'default.jpg' // Ruta de la imagen predeterminada
        ];
    }
}

// Preparar los datos de respuesta
$responseData = [
    'title' => $postData['title'],
    'content' => $postData['content'],
    'image' => $postData['image'],
    'creator' => [
        'username' => $creatorData['username'],
        'image' => $creatorData['image']
    ],
    'comments' => $commentsData
];

// Devolver los datos como JSON
header('Content-Type: application/json');
echo json_encode($responseData);
?>

