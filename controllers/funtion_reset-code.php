<?php
require_once('../src/Models/conexion.php');
$conn = new conexion();

$pdo = $conn->getPdo();

if (isset($_POST['code'])) {
    $_SESSION['info'] = "";
    $otp_code = $_POST['code'];
    $check_code = "SELECT * FROM users WHERE code = :code";
    
    // Preparar la consulta
    $stmt = $pdo->prepare($check_code);
    $stmt->bindParam(':code', $otp_code, PDO::PARAM_INT);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0){
        $fetch_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $info = "Crea una nueva contraseña que no utilice en ningún otro sitio.";
        $_SESSION['info'] = $info;
        header('location: ../src/views/cpassword.php');
        exit();
    } else {
        $errors['otp-error'] = "¡Has introducido un codigo incorrecto!";
    }    
}
?>
