<?php
// Inicia la sesión (si aún no está iniciada)
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
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../css/styles-login.css">
</head>

<body>

    <div class="container">
        <div class="image-container">
            <h1>ShareSphere<br>Comunidad global, impacto local</h1>
        </div>
        <div class="form-container">
            <img src="../images/Logo.png" class="logo">
            <h2>Iniciar Sesion</h2>
            <form action="../../controllers/login.php" method="post">
                <input type="text" id="email" name="email" class="input-field" placeholder="Correo electronico"
                    required>
                <input type="password" id="password" name="password" class="input-field" placeholder="Contraseña"
                    required>
                <input type="submit" value="Iniciar Sesion">
                <a class="password" href="./code.php">¿Contraseña Olvidada?</a>
                <h3>¿Aun no eres miembro?</h3>
                <a class="Register" href="./register.php">Registrarme</a>
                <a class="visit" href="../views/visitor.php">Regresar Como Visitante</a>
            </form>
        </div>
    </div>

</body>

</html>
