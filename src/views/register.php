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

<div class="content-wrapper">
    <div class="container">
        <div class="image-container">
            <h1>ShareSphere<br>Comunidad global, impacto local</h1>
        </div>
        <div class="form-container">
            <img src="../images/Logo.png" class="logo">
            <h2>Registrarse en ShareSphere</h2>
            <form action="../../controllers/funtion_register.php" method="post">
                <input type="name" id="name" name="name" class="input-field" placeholder="Nombre" required>
                <input type="lastname" id="lastname" name="lastname" class="input-field" placeholder="Apellido" required>
                <input type="name-user" id="nickname" name="nickname" class="input-field" placeholder="Nombre de Usuario" required>
                <input type="email" id="email" name="email" class="input-field" placeholder="Correo electrónico" required>
                <input type="password" id="password" name="password" class="input-field" placeholder="Contraseña" required>
                <input type="password" id="confirm_password" name="confirm_password" class="input-field" placeholder="Confirmar contraseña" required>
                <p class="code-opcion">Opcional
                <input type="code" id="code-admin" name="code-admin" class="input-field" placeholder="Código de Acceso">
                </p>
                <input type="submit" value="Registrarse">
                <p class="login-link">¿Ya tienes una cuenta? <br>
                    <a href="./login.php">Inicia sesión aquí</a>
                </p>
            </form>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-about">
                <h4>Sobre Nosotros</h4>
                <p>Foro web desarrollada como proyecto escolar.</p>
            </div>
            <div class="footer-links">
                <h4>Enlaces Rápidos</h4>
                <ul>
                    <li><a href="./register.php">Registrarte</a></li>
                    <li><a href="./login.php">Iniciar Sesión</a></li>
                    <li><a href="./visitor.php">Visitante</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h4>Nosotros:</h4>
                <p>Ambriz Chavez Jose Alberto</p>
                <p>Jose David Aguilar Avalos</p>
                <p>García Rea Ulises Gerardo</p>
                <p>García Gámez Marco Antonio</p>
                <p>San Millan Ramos Alan Adolfo</p>
                <p>Casillas Sánchez Ramón Dalai </p>
            </div>
            <div class="footer-social">
                <h4>Síguenos</h4>
                <ul class="social-icons">
                    <li><a href="https://www.twitter.com" target="_blank">Portafolios</a></li>
                    <li><a href="https://www.twitter.com" target="_blank">Github</a></li>
                    <li><a href="https://www.instagram.com" target="_blank">Instagram</a></li>
                    <li><a href="https://www.linkedin.com" target="_blank">LinkedIn</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 ShareSphere. Todos los derechos reservados.</p>
        </div>
    </footer>
</div>

</body>
</html>
