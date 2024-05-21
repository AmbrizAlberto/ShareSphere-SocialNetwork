<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>

    <link rel="stylesheet" href="../css/PassForg.css">
</head>

<body>
    <div class="content-wrapper">
        <div class="container">
            <div class="contain">
                <h1>Contraseña Olvidada?<br>No te preocupes</h1>
                <form action="../../controllers/funtion_code.php" method="post" id="MyForm">
                    <input type="text" class="input-field" placeholder="Ingresa tu correo" name="email" required>
                    <button type="submit" class="button" value="Iniciar sesión">Continuar</button>
                </form>
                <a class="login" href="./login.php">Regresar</a>
            </div>
        </div>

        <footer>
            <div class="footer-container">
                <div class="footer-about">
                    <h4>Sobre Nosotros</h4>
                    <p>Foro web desarrollada como proyecto escolar</p>
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