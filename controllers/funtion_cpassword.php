<?php

require_once('../src/Models/conexion.php');
$conn = new conexion();

$pdo = $conn->getPdo();

if(isset($_POST['password'])){
    $_SESSION['info'] = "";
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    if($password !== $cpassword){
        $errors['password'] = "¡La contraseña no coincide, vuelve a verificarlo!";
    }else{
        $code = 0;
        $email = $_SESSION['email']; 
        $encpass = password_hash($password, PASSWORD_BCRYPT);

        // Utilizamos una sentencia preparada con marcadores de posición
        $update_pass = "UPDATE users SET code = :code, password = :encpass WHERE email = :email";
        $stmt = $pdo->prepare($update_pass);
        $stmt->bindParam(':code', $code, PDO::PARAM_INT);
        $stmt->bindParam(':encpass', $encpass, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        
        if($stmt->execute()){
            $info = "Tu contraseña ha sido cambiada. Ingresa ahora con tu nueva contraseña.";
            $_SESSION['info'] = $info;
            header('Location: ../src/views/login.php');
        }else{
            $errors['db-error'] = "No se pudo cambiar tu contraseña";
        }
    }
}

?>
