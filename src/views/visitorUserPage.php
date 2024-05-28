<?php
session_start();
require_once ("../../autoload.php");
use Models\{posts};

$posts = new posts();
$postList = $posts->GetPostsByIdUser($_GET['idPerfil']);
$userProfile = $posts->GetUserById($_GET['idPerfil']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ShareSphere</title>

  <link rel="stylesheet"
    href="<?php echo '../css/main.css'//echo $user['theme'] =='0' ?  '../css/light-mode.css':  '../css/main.css' ?>">
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../css/textpost.css">
  <link rel="stylesheet" href="../css/photopost.css">
  <link rel="stylesheet" href="../css/PerfilPage.css">
  <link rel="stylesheet" href="../css/modal.css">
  <link rel="stylesheet" href="../css/modalEdit.css">


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="icon" href="../images/Logo-cut.png" type="image/png">

</head>

<body>
  <div class="navbar" style="height: 13%;">
    <div class="access">
      <!-- ACCESOS -->
      <a href="./visitor.php"><button class="optionnv"><i class="bi bi-house-fill"></i></i><span>Home</span></button></a>
    </div>
  </div>

  <div class="main">
    <!-- HEADER MAIN -->
    <div class="feedhead">

      <div class="logo">
        <a href="./main.php"><img src="../images/Logo-cut.png" alt="Logo"></a>
      </div>

      <button id="theme-toggle-btn">
        <i class="bi bi-lightbulb-fill"></i>
      </button>

      <!-- NOMBRE DE PAGINA -->
      <a href="./main.php" class="ShSp">
        <h1 href="./main.php">ShareSphere</h1>
      </a>

      <!-- BUSCADOR -->
      <div class="search-nav">
          <form action="#" method="get">
              <input type="text" placeholder="Buscar..." name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search'], ENT_QUOTES) : ''; ?>">
          </form>
      </div>

      <a href="/src/views/login.php" class="login"><i class="bi bi-box-arrow-in-left"> Iniciar Sesion</i></a>
      <!-- Cerramos la sesion -->

    </div>

    <div class="PerfilPage">

      <div class="PerfilDatos">
        <div class="PerfilPortada">
          <img
            src="<?php echo $userProfile['coverImg'] ? "/public/fondo_users/" . $userProfile['coverImg'] : "/public/fondo_users/fondodefault.png" ?>"
            alt="#" style="height: auto; wight: 300;">
        </div>

        <div class="PerfilPhoto">
          <img
            src="<?php echo $userProfile['image'] ? "/public/images_users/" . $userProfile['image'] : "/public/images_users/userdefault.png" ?>"
            alt="">
        </div>
        <div class="PerfilName">
          <h1><?php echo $userProfile['username'] ?></h1>
        </div>
        <div class="PerfilDescription">
          <h2><?php echo $userProfile['descripcion'] ? $userProfile['descripcion'] : "Sin descripcion" ?></h2>
        </div>
      </div>

    </div>

    <!-- El modal -->
    <div id="myModalEdit" class="modaledit">
      <!-- Contenido del modal -->
      <div class="modal-content-edit">
        <span class="close-edit">&times;</span>
        <h2>Editar Perfil</h2>
        <form id="editForm" action="/controllers/Edit/EditUser.php" method="post" enctype="multipart/form-data">
          <input type="hidden" value="<?php echo $_SESSION['userId']; ?>" name="userId">
          <label for="newImage">Cargar imagen:</label><br>
          <img id="previewImage" src="<?php echo "/public/images_users/" . $user['image'] ?>" alt="User Image"
            class=".modal-content-edit">
          <input type="file" id="newImage" name="newImage" accept="image/*"><br><br>
          <label for="newUsername">Nombre de Usuario:</label><br>
          <input type="text" id="newUsername" name="newUsername" value="<?php echo $user['username'] ?>"><br><br>
          <label for="newDescription">Descripción:</label><br>
          <textarea id="newDescription" name="newDescription" rows="4"
            cols="50"><?php echo $user['descripcion'] ?></textarea><br><br>
          <button class=".modal-content-edit " type="submit" value="Guardar cambios">Guardar</button>
        </form>
      </div>
    </div>
    <?php foreach ($postList as $post) { ?>
      <div class="post-container" style="right: 11%;">
        
        <h2 class="post-content"> <?php echo $post['title'] ?> </h2><br>
        <h3 class="SubTitle">
          <?php switch ($post['SubgroupId']) {
            case '1':
              echo "Agua Limpia y Saneamineto";
              break;
            case '3':
              echo "Energia Asequible y No Contaminante";
              break;
            case '4':
              echo "Vida Submarina";
              break;
          } ?>
        </h3>
        <div class="description">
          <h3><?php echo $post['content'] ?></h3>
        </div>
        <div class="image-container">
          <img src="<?php echo "/public/images_posts/" . $post['image'] ?>" alt="Imagen de la publicacion">
        </div>
        <div class="post-actions">
          <!-- Like -->
          <button class="action-btn like-button" data-post-id="<?php echo $post['id']; ?>">
            <i class="bi bi-hand-thumbs-up-fill"></i>
            <span id="like-count-<?php echo $post['id']; ?>"><?php echo $posts->GetLikesCount($post['id']); ?></span>
          </button>
        </div>
      </div>
    <?php } ?>

    <button class="toTop" id="toTop">
      <svg viewBox="0 0 24 24">
        <path d="m4 16 8-8 8 8"></path>
      </svg>
    </button>

    <script src="../js/scriptedituser.js"></script>
    <script src="../js/light-darkMode.js"></script>