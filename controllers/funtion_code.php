<?php
require_once('../src/Models/conexion.php');
$conn = new conexion();

$pdo = $conn->getPdo();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Generar un código de cambio de contraseña aleatorio
    $code = bin2hex(random_bytes(4));

    // Actualizar el código en la base de datos
    $sql = "UPDATE user SET code = :code WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':code', $code);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Enviar el correo de confirmación
    $to = $email;
    $subject = "Cambio de Contraseña";
    $message = "Tu código de restablecimiento de contraseña es: " . $code;
    $headers = "From: from@example.com";

    if(mail($to, $subject, $message, $headers))
    {
        echo "<script>
            alert('Se ha enviado un correo electrónico con tu código de restablecimiento de contraseña.');
            window.location.href = '../src/views/reset.php';
        </script>";
    }
    else
    {
        echo "<script>
            alert('El mensaje no pudo ser enviado.');
            window.location.href = '../src/views/reset.php';
        </script>";
    }
}
?>