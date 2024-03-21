<?php
require_once("./autoload.php");
use models\users as users;
$users = new users();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShareSphere</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/css/root.css">
</head>
<body class="container-fluid bg-dark">
    <section class="index_section row">
        <!-- Here starts the navbar -->
        <nav class="navHome d-flex flex-column flex-shrink-0 bg-dark p-0 border-end" style="width: 4.5rem; position: sticky; height: 100vh; top: 0;">
            <a href="#" class="d-block bg-dark py-3 text-decoration-none mx-auto" data-bs-toggle="tooltip" data-bs-placement="right" title="ShareSphere">
                <img src="../images/Logo-cut.png" alt="" srcset="" style="width: 45px;">
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item">
                    <a href="./main.php" class="nav-link active py-3 border-bottom rounded-0 bg-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Main">
                        <iconify-icon icon="ic:round-home" width="40" height="40"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="./main.php" class="option_container nav-link py-3 border-bottom rounded-0 link-light bg-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Agua Limpia y Saneamiento">
                        <img src="./src/images/6.png" width="40" height="40" alt="Agua Limpia y Saneamiento">
                    </a>
                </li>
                <li class="option">
                    <a href="./main.php" class="option_container nav-link py-3 border-bottom rounded-0 link-light bg-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Energía Asequible y no contaminable">
                        <img src="./src/images/7.png" width="40" height="40" alt="Energía Asequible y no contaminable">
                    </a>
                </li>
               
                <li class="option">
                    <a href="./main.php" class="option_container nav-link py-3 border-bottom rounded-0 link-light bg-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Vida Submarina">
                        <img src="./src/images/14.jpg" width="40" height="40" alt="Vida Submarina">
                    </a>
                </li>
            </ul>
            <div class="border-top dropup">
                <a href="#" class="d-flex bg-dark align-items-center justify-content-center p-3 link-light text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown"  data-bs-offset="10,0">
                    <iconify-icon class="iconify" icon="lets-icons:user-cicrle-duotone" width="30" height="30"></iconify-icon>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#" class="dropdown-item">Usuario ####</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a href="#" class="dropdown-item disabled" tabindex="-1"></a></li>
                    <li><a href="#" class="dropdown-item disabled" tabindex="-1"></a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a href="" class="dropdown-item text-danger">Cerrar Sesion</a></li>
                </ul>
            </div>
        </nav>
        <!-- Here ends the navbar -->

        <!-- Container with the options starts here -->
        <section class="main_container col-lg-11 bg-dark">         
            <main class="dashboard_main container m-5">
                <h2 class="row h1 text-white">ShareSphere</h2>
                <h4 class="row h2 mb-5 text-white">
                    Administración, aquí podrás administrar las publicaciones y usuarios que se encuentran en el foro.
                </h4>
                <section class="row">
                    <a href="" class="col text-decoration-none">
                        <div class="dashboard_options option_container card bg-secondary">
                            <h3 class="h2 card-header accordion-header" >Publicaciones</h3>
                            <div class="card-body">
                                <div class="card-body d-flex justify-content-center">
                                    <iconify-icon class="iconify " icon="mdi:post-it-note-text" width="100" height="100"></iconify-icon>
                                </div>
                                <h4 class="card-title">Publicaciones</h4>
                            </div>
                        </div>
                    </a>
                    <a href="" class="col  text-decoration-none">
                        <div class="dashboard_options option_container card bg-secondary">
                            <h3 class="h2 card-header">Usuarios</h3>
                            <div class="card-body">
                                <div class="card-body d-flex justify-content-center">
                                    <iconify-icon class="iconify" icon="ph:users-four-duotone" width="100" height="100"></iconify-icon>
                                </div>
                                <h4 class="card-title"> <?= $users->GetUsuariosIndex(); ?> Usuarios</h4>
                            </div>
                        </div>
                    </a>
                    <!--
                    <a href="" class="col text-decoration-none">
                        <div class="dashboard_options option_container">
                            <div class="dashboard_options option_container card">
                                <h3 class="h2 card-header">No se me ocurre nada</h3>
                                <div class="card-body">
                                    <div class="card-body d-flex justify-content-center">
                                    <iconify-icon class="iconify" icon="bi:arrow-left-right" width="100" height="100"></iconify-icon>
                                    </div>
                                    <h4 class="card-title">No se me ocurre nada</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                    -->
                    <a href="" class="col text-decoration-none">
                        <div class="dashboard_options option_container">
                            <div class="dashboard_options option_container card bg-secondary">
                                <h3 class="h2 card-header">Movimientos Tk</h3>
                                <div class="card-body">
                                    <div class="card-body d-flex justify-content-center">
                                    <iconify-icon class="iconify" icon="ic:twotone-generating-tokens" width="100" height="100"></iconify-icon>
                                    </div>
                                    <h4 class="card-title">Movimientos Tk</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </section>
            </main>
        </section>
        <!-- Container with the options ends here -->
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="./sources/js/app.js"></script>
</html>
