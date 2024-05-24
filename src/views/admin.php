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
    <link rel="stylesheet" href="../css/modal_admin.css">

    <link rel="icon" href="../images/Logo-cut.png" type="image/png">


    <!-- <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/textpost.css">
    <link rel="stylesheet" href="../css/photopost.css">
    <link rel="stylesheet" href="../css/modal.css">
    <link rel="stylesheet" href="../css/Post.css">
    <link rel="stylesheet" href="../css/modalEdit.css">
    !-->
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
                <button class="optionnv" href="#"><i class="bi bi-house-fill"></i><span>Home</span></button>

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
                <a class="optionnv" href="/controllers/logout.php"><i
                        class="bi bi-box-arrow-left"></i></i><span>Salir</span></a>

            </div>
        </div>
    </header>

    <div class="content">
        <div class="top">
            <h1>ADIMISTRACION</h1>
        </div>

        <div class="container">
            <button class="postscont" onclick="openModalForProject(1)">
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
            </button>

            <button class="postscont" onclick="openModalForProject(2)">
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
            </button>

            <button class="postscont" onclick="window.location.href='../views/main-admin.php'">
                <div class="titulo">
                    Explorar
                </div>
                <div class="contador">
                    <div class="iconcont">
                        <i class="bi bi-globe2"></i>                    
                    </div>
                    <div class="numero">
                        Ver publicaciones recientes
                    </div>
                </div>
            </button>
        </div>

        <!-- Modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <div id="modalContent"></div>
            </div>
        </div>

        <script src="../js/modal_admin_user.js"></script>

    </div>
</body>

</html>