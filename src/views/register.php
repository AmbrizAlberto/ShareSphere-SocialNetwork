<?php
// Inicia la sesión
session_start();

// Verifica si hay una sesión activa
if (isset($_SESSION['email'])) {
    // Si hay una sesión iniciada, redirige al usuario a la página principal
    header('Location: ./main.php');
    exit; // Detiene la ejecución del script
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registro</title>
<link rel="stylesheet" type="text/css" href="../css/styles-registre.css">
</head>
<body>

<div class="container">
    <div class="image-container">
        <h1>ShareSphere<br>Comunidad global, impacto local</h1>
    </div>
    <div class="form-container">
        <img src="../images/Logo.png" class="logo">
        <h2>Registrarse en Sheresphere</h2>
        <form action="../../controllers/funtion_register.php" method="post">
            <input type="name" id="name" name="name" class="input-field" placeholder="Nombre" required>
            <input type="lastname" id="lastname" name="lastname" class="input-field" placeholder="Apellido" required>
            <input type="name-user" id="nickname" name="nickname" class="input-field" placeholder="Nombre de Usuario" required>
            <input type="email" id="email" name="email" class="input-field" placeholder="Correo electrónico" required>
            <input type="password" id="password" name="password" class="input-field" placeholder="Contraseña" required>
            <input type="password" id="confirm_password" name="confirm_password" class="input-field" placeholder="Confirmar contraseña" required>
            <input type="submit" value="Registrarse">
            <p class="login-link">¿Ya tienes una cuenta? <br>
                <a href="./login.php">Inicia sesión aquí</a></p>
        </form>
    </div>
</div>

</body>
</html>
