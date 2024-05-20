<?php
require_once ('../src/Models/conexion.php');
use Models\Conexion;

$conn = new conexion();

$pdo = $conn->getPdo();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];
    $new_password = $_POST['new_password'];

    // Verificar si la nueva contraseña tiene al menos 6 caracteres
    if (strlen($new_password) < 6) {
        echo "<script>
            alert('La contraseña debe tener al menos 6 caracteres.');
            window.location.href = '../src/views/reset.php';
        </script>";
    } else {
        // Verificar si el código coincide con el de la base de datos
        $sql = "SELECT * FROM user WHERE code = :code";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':code', $code);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            // Actualizar la contraseña en la base de datos
            $sql = "UPDATE user SET passwordHash = :new_password WHERE code = :code";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':new_password', $hashed_password);
            $stmt->bindParam(':code', $code);
            $stmt->execute();

            echo "<script>
                alert('Tu contraseña ha sido restablecida con éxito.');
                window.location.href = '../src/views/login.php';
            </script>";
        } else {
            echo "<script>
                alert('El código de restablecimiento de contraseña no es válido.');
                window.location.href = '../src/views/reset.php';
            </script>";
        }
    }
}
?>