<?php
require_once('../autoload.php');
use Models\{posts, conexion};
use PDO, PDOException;

$conn = new conexion();
$pdo = $conn->getPdo();

session_start();

// Verificar si el usuario está logueado y el email está en la sesión
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    try {
        // Preparar la consulta para actualizar el valor de admin
        $stmt = $pdo->prepare("UPDATE user SET admin = 0 WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Consulta ejecutada correctamente
        } else {
            // Error al ejecutar la consulta
            echo "Error al actualizar el valor de admin.";
        }
    } catch (PDOException $e) {
        // Manejar errores de PDO
        echo "Error: " . $e->getMessage();
    }
}

// Destruir la sesión
session_unset();
session_destroy();

// Redirigir al login
header('Location: ../src/views/login.php');
exit;
?>
