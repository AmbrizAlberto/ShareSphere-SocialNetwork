<?php
// /controllers/Set/SetVote.php
require_once '../autoload.php';  // Ajustar ruta según necesidad

if (!isset($_SESSION)) {
    session_start();
}

$userId = $_SESSION['user_id'] ?? null;
$postId = $_POST['post_id'] ?? null;
$voteType = $_POST['vote_type'] ?? null;  // 'UPVOTE' o 'DOWNVOTE'

if (!$userId || !$postId || !$voteType) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

$database = new DatabaseConnection();  // Asume una clase existente para conexión

try {
    // Verificar si ya existe un voto del usuario
    $existingVote = $database->query("SELECT type FROM Vote WHERE user_id = ? AND post_id = ?", [$userId, $postId])->fetchColumn();
    
    if ($existingVote) {
        if ($existingVote == $voteType) {
            // Si el tipo de voto es el mismo, eliminarlo (desvotar)
            $database->execute("DELETE FROM Vote WHERE user_id = ? AND post_id = ?", [$userId, $postId]);
        } else {
            // Cambiar tipo de voto
            $database->execute("UPDATE Vote SET type = ? WHERE user_id = ? AND post_id = ?", [$voteType, $userId, $postId]);
        }
    } else {
        // Crear nuevo voto
        $database->execute("INSERT INTO Vote (user_id, post_id, type) VALUES (?, ?, ?)", [$userId, $postId, $voteType]);
    }
    
    echo json_encode(['success' => true, 'message' => 'Voto actualizado']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error en la base de datos']);
}
?>
