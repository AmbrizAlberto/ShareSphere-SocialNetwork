<?php
require_once "../../autoload.php";
use models\{posts, users};

$posts = new posts();
$users = new users();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShareSphere Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <a href="./main.php">
                    <img src="../images/Logo-cut.png" alt="Logo"
                        style="font-size: 24px; background-color: transparent; border: none;">
                </a>
            </div>

            <div class="access">
                <br /><br />
                <button class="optionnv" href="#"><i class="bi bi-house-fill"></i></i><span>Home</span></button>

                <div class="botonimg">
                    <button class="botonimgs">
                        <img src="../../src/images/6.png" alt="Agua Limpia y Saneamiento">
                    </button>
                    <button class="botonimgs">
                        <img src="../../src/images/7.png" alt="Energía Asequible y no contaminable">
                    </button>
                    <button class="botonimgs">
                        <img src="../../src/images/14.jpg" alt="Vida Submarina">
                    </button>
                </div>
                <button class="optionnv" href="./PerfilPage.php"><i
                        class="bi bi-box-arrow-left"></i></i><span>Salir</span></button>

            </div>
        </div>
    </header>

    <div class="content">


        <div class="top">
            <h1>ADIMISTRACION</h1>
        </div>

        <div class="container">
            <div class="postscont">
                <div class="titulo">
                    Publicaciones
                </div>
                <div class="contador">
                    <div class="iconcont">
                        <i class="bi bi-postcard"></i>
                    </div>
                    <div class="numero">
                        <?= $posts->GetPostsIndex(); ?> publicaciones
                    </div>
                </div>
            </div>

            <!-- Repite el bloque anterior dos veces más para tener 3 elementos -->

            <div class="postscont">
                <div class="titulo">
                    Usuarios
                </div>
                <div class="contador">
                    <div class="iconcont">
                        <i class="bi bi-person-lines-fill"></i>
                    </div>
                    <div class="numero">
                        <?= $users->GetUsuariosIndex(); ?> Usuarios
                    </div>
                </div>
            </div>

            <div class="postscont">
                <div class="titulo">
                    Reportes
                </div>
                <div class="contador">
                    <div class="iconcont">
                        <i class="bi bi-flag"></i>
                    </div>
                    <div class="numero">
                        No se que mas poner aqui
                    </div>
                </div>
            </div>
        </div>


    </div>
</body>