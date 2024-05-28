<?php //Funcion para evitar que los usuarios sin sesion iniciada puedan acceder al main
session_start();// Iniciar la sesión
if (isset($_SESSION['email'])) {
    header("Location:./main.php");

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../css/styles-login.css">

    <link rel="stylesheet" type="text/css" href="../css/ResponsiveLogin.css">

    <link rel="icon" href="../images/Logo-cut.png" type="image/png">

</head>

<body>
    <div class="content-wrapper">
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
                    <input type="code" id="code-admin" name="code-admin" class="input-field" placeholder="Codigo Opcional">
                    <input type="submit" value="Iniciar Sesion">
                    <a class="password" href="./code.php">¿Contraseña Olvidada?</a>
                    <h3>¿Aun no eres miembro?</h3>
                    <a class="Register" href="./register.php">Registrarme</a>
                    <a class="visit" href="../views/visitor.php">Ingresar Como Visitante</a>
                </form>
            </div>
        </div>

        <footer>
            <div class="footer-container">
                <div class="footer-about">
                    <h4>Sobre Nosotros</h4>
                    <p>ShareSphere. Foro web desarrollado como proyecto escolar.
                    <p>Universidad de Colima.
                    <p>FIE</p>
                    </p>
                    </p>
                </div>
                <div class="footer-links">
                    <h4>Enlaces Rápidos</h4>
                    <ul>
                        <li><a href="./register.php">Registrarte</a></li>
                        <li><a href="./login.php">Iniciar Sesion</a></li>
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