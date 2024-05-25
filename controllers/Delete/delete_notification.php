<?php
// delete_notification.php
namespace controllers;

session_start();
require_once ("../../autoload.php");
use models\posts;

if (empty($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

if (isset($_POST['notificationId'])) {
    $posts = new posts();
    $notificationId = $_POST['notificationId'];
    
    if ($posts->DeleteNotificationById($notificationId)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete notification']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Notification ID not provided']);
}

// Obtener las notificaciones después de eliminar la notificación
$posts = new posts();
$notifications = $posts->GetNotifications($_SESSION['userId']);
$hasNotifications = count($notifications) > 0;
?>
