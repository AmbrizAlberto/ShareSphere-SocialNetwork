<?php
session_start();
require_once("../../autoload.php");
use Models\{posts};
$posts = new posts();
$postList = $posts->GetPostsByIdUser($_GET['idPerfil']);
$user = $posts->GetUserById($_SESSION['userId']);
$userProfile = $posts->GetUserById($_GET['idPerfil']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShareSphere</title>

    <link rel="stylesheet" href="<?php echo '../css/main.css'//echo $user['theme'] =='0' ?  '../css/light-mode.css':  '../css/main.css'?>">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/textpost.css">
    <link rel="stylesheet" href="../css/photopost.css">
    <link rel="stylesheet" href="../css/PerfilPage.css">
    <link rel="stylesheet" href="../css/modal.css">
    <link rel="stylesheet" href="../css/modalEdit.css">


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>

    <header>
      <div class="navbar">
        <div class="logo">
          <a href="./main.php">
              <img src="../images/Logo-cut.png" alt="Logo" style="font-size: 24px; background-color: transparent; border: none;">
          </a>
        </div>

        <div class="access">
        <br /><br />
        <a href="./main.php"><button class="optionnv"><i class="bi bi-house-fill"></i></i><span>Home</span></button></a>
        <a href="#"><button class="optionnv"><i class="bi bi-person-circle"></i></i><span>Profile</span></button></a>
        
      </div>
    </header>
    
    <div class="main">
        <div class="feedhead">
            <h1>ShareSphere</h1>

            <div class="search-nav">
            <form action="#" method="get">
              <input type="text" placeholder="Buscar..." name="search">
            </form>
            </div>

            <form action="./PerfilPage.php" method="post">
              <input type="image" src="<?php echo $user['image'] ? "/public/images_users/".$user['image'] : "/public/images_users/userdefault.png" ?>" alt="Texto Alternativo">
            </form>
  
            <button id="modalBtn">
              <i class="bi bi-plus-square"></i>
            </button>
            <div id="myModal" class="modal">
              <div class="modal-content">
                <span class="close" id="closeBtn">&times;</span>
                <form action="/controllers/Set/SetPost.php" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?php  echo $_SESSION['userId'];?>" name="post_creator_id">
                <input type="hidden" value="0" name="currentPage">
                  <label for="tema">Tema:</label>
                  <select id="selector" name="post_subgroup_id" required>
                    <option value="1">Agua Limpia y Saneamineto</option>
                    <option value="3">Energia Asequible y No Contaminante</option>
                    <option value="4">Vida Submarina</option>
                    <!-- Agrega más opciones según sea necesario -->
                </select>
                  <label for="texto">Titulo:</label>
                  <textarea id="texto" name="post_title" rows="1" required placeholder="Titulo..."></textarea>
                  <label for="texto">Texto:</label>
                  <textarea id="texto" name="post_content" rows="4" required></textarea>
          
                  <label for="foto">Foto:</label>
                  <input type="file" id="foto" name="image" accept="image/*">
          
                  <button type="submit">Enviar</button>
              </form>
              </div>
            </div>
            <script src="../js/script.js"></script>
            
            <button>
              <i class="bi bi-app-indicator"></i>
            </button>

            <a href="../../controllers/logout.php" class="logout"><i class="bi bi-box-arrow-right"></i></a>
          </div>


          <div class="PerfilPage">

            <div class="PerfilDatos">
                <div class="PerfilPortada">
                    <img src="<?php echo $userProfile['coverImg'] ? "/public/fondo_users/".$userProfile['coverImg'] : "/public/fondo_users/fondodefault.png" ?>" alt="#" style="height: auto; wight: 300;">
                </div>
        
                <div class="PerfilPhoto">
                    <img src="<?php echo $userProfile['image'] ? "/public/images_users/".$userProfile['image'] : "/public/images_users/userdefault.png" ?>" alt="">
                </div>
                <div class="PerfilName">
                    <h1><?php echo $userProfile['username'] ?></h1>
                </div>
                <div class="PerfilDescription">
                    <h2><?php echo $userProfile['descripcion'] ? $userProfile['descripcion'] : "Sin descripcion"?></h2>
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
                    <input type="hidden" value="<?php  echo $_SESSION['userId'];?>" name="userId">
                    <label for="newImage">Cargar  imagen:</label><br>
                    <img id="previewImage" src="<?php echo "/public/images_users/". $user['image']?>" alt="User Image" class=".modal-content-edit">
                    <input type="file" id="newImage" name="newImage" accept="image/*"><br><br>
                    <label for="newUsername">Nombre de Usuario:</label><br>
                    <input type="text" id="newUsername" name="newUsername" value="<?php echo $user['username']?>"><br><br>
                    <label for="newDescription">Descripción:</label><br>
                    <textarea id="newDescription" name="newDescription" rows="4" cols="50"><?php echo $user['descripcion']?></textarea><br><br>
                    <button class=".modal-content-edit " type="submit" value="Guardar cambios">Guardar</button> 
                </form>
            </div>
        </div>
          <?php foreach($postList as $post){?>
          <div class="post-container">
            <div class="post-options">
              <span><i class="bi bi-caret-down-fill"></i></span>
              <div class="option-content">
              </div>
            </div>
            <h2 class="post-content"> <?php echo $post['title']?> </h2><br>
            <h3 class="SubTitle"> <?php switch ($post['SubgroupId']) { case '1': echo "Agua Limpia y Saneamineto"; break; case '3': echo "Energia Asequible y No Contaminante"; break; case '4': echo "Vida Submarina"; break; }?> </h3>
            <div class="description">
              <h3><?php echo $post['content']?></h3>
            </div>
            <div class="image-container">
              <img src="<?php echo "/public/images_posts/".$post['image']?>" alt="Imagen de la publicacion">
            </div>
            <div class="post-actions">
              <button class="action-btn"><i class="bi bi-hand-thumbs-up-fill"></i></button>
              <button class="action-btn"><i class="bi bi-hand-thumbs-down-fill"></i></button>
              <button class="action-btn"><i class="bi bi-chat-square-text-fill"></i></button>
            <div>
              <span class="likes">100 Likes</span>
              <span class="comments">50 Comments</span>
              </div>
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