<?php
require_once('../src/Models/conexion.php');
$conn = new conexion();

$pdo = $conn->getPdo();

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $check_email_query = "SELECT * FROM users WHERE email = :email";
    
    // Preparar la consulta
    $stmt = $pdo->prepare($check_email_query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $code = rand(999999, 111111);
        $update_code_query = "UPDATE users SET code = :code WHERE email = :email";
        
        // Preparar la consulta para actualizar el código
        $stmt = $pdo->prepare($update_code_query);
        $stmt->bindParam(':code', $code, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $subject = "Código para cambiar contraseña";
            $message = "Tu código para cambiar tu contraseña es: $code";
            $sender = "From: alansanmillanr@gmail.com";
            
            // Envío de correo electrónico
            if (mail($email, $subject, $message, $sender)) {
                $info = "Hemos enviado un código a tu correo electrónico para el cambio de contraseña: $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('Location:../src/views/reset-code.php');
                exit();
            } else {
                $errors['otp-error'] = "¡Error al enviar el código!";
            }
        } else {
            $errors['db-error'] = "¡Algo salió mal al actualizar el código!";
        }
    } else {
        $errors['email'] = "¡Esta dirección de correo electrónico no existe!";
    }
}
?>
