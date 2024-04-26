<?php
require_once("../../autoload.php");
use Models\{posts};
$posts = new posts();
$postList = $posts->GetPostsByIdUser($_SESSION['userId']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShareSphere</title>

    <link rel="stylesheet" href="../css/main.css">
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
              <input
                type="image"
                src="https://img.freepik.com/foto-gratis/joven-barbudo-camisa-rayas_273609-5677.jpg?w=740&t=st=1702678697~exp=1702679297~hmac=c54395be72f5a4c41e214867636a5cc62b7244b9da21862a94571399b52a2953"
                alt="Texto Alternativo"/>
            </form>
  
            <button id="modalBtn">
              <i class="bi bi-plus-square"></i>
            </button>
            <div id="myModal" class="modal">
              <div class="modal-content">
                <span class="close" id="closeBtn">&times;</span>
                <form>
                  <label for="tema">Tema:</label>
                  <select id="selector" name="selector">
                    <option value="opcion1">Opción 1</option>
                    <option value="opcion2">Opción 2</option>
                    <option value="opcion3">Opción 3</option>
                    <!-- Agrega más opciones según sea necesario -->
                </select>
          
                  <label for="texto">Texto:</label>
                  <textarea id="texto" name="texto" rows="4" required></textarea>
          
                  <label for="foto">Foto:</label>
                  <input type="file" id="foto" name="foto" accept="image/*">
          
                  <button type="button" onclick="submitForm()">Enviar</button>
              </form>
              </div>
            </div>
            <script src="script.js"></script>
            
            <button>
              <i class="bi bi-app-indicator"></i>
            </button>

            <a href="../../controllers/logout.php" class="logout"><i class="bi bi-box-arrow-right"></i></a>
          </div>


          <div class="PerfilPage">

            <div class="PerfilDatos">
                <div class="PerfilPortada">
                    <img src="https://i.pinimg.com/736x/b3/08/cc/b308cc852be780b03a9873ef42ce71f5.jpg" alt="#">
                    <button id="modalBtnEdit" type="button" class="editbtn">
                        <i class="bi bi-pencil-fill"></i> Editar
                    </button>
                </div>
        
                <div class="PerfilPhoto">
                    <img src="https://img.freepik.com/foto-gratis/joven-barbudo-camisa-rayas_273609-5677.jpg?w=740&t=st=1702678697~exp=1702679297~hmac=c54395be72f5a4c41e214867636a5cc62b7244b9da21862a94571399b52a2953" alt="">
                </div>
                <div class="PerfilName">
                    <h1>Name</h1>
                </div>
                <div class="PerfilDescription">
                    <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, dolorum. Illo aut iure sapiente ex a eaque, vitae eum laudantium quibusdam at consequatur ab magnam soluta, sequi aliquid accusantium saepe.</h2>
                </div>
            </div>
        
        </div>
        
        <!-- El modal -->
        <div id="myModalEdit" class="modaledit">
            <!-- Contenido del modal -->
            <div class="modal-content-edit">
                <span class="close-edit">&times;</span>
                <h2>Editar Perfil</h2>
                <form id="editForm">
                    <label for="newImage">Cargar nueva imagen:</label><br>
                    <input type="file" id="newImage" name="newImage"><br><br>
                    <label for="newUsername">Nombre de Usuario:</label><br>
                    <input type="text" id="newUsername" name="newUsername"><br><br>
                    <label for="newDescription">Descripción:</label><br>
                    <textarea id="newDescription" name="newDescription" rows="4" cols="50"></textarea><br><br>
                    <button class=".modal-content-edit " type="submit" value="Guardar cambios">Guardar</button> 
                </form>
            </div>
        </div>
          
          <div class="post-container">
            <div class="user-info">
              <img src="../images/Uli.png" alt="User Image">
              <span>
            </div>
            <div class="post-options">
              <span><i class="bi bi-caret-down-fill"></i></span>
              <div class="option-content">
                <a href="#"><i class="bi bi-pencil-fill"></i></a>
                <a href="#"><i class="bi bi-trash-fill"></i></a>
              </div>
            </div>
            <h2 class="post-content">

            </h2>
            <h3 class="SubTitle">
              Tema de la onu
            </h3>
            <div class="description">
            </div>
            <div class="image-container">
                <img src="/public/images_posts/backg.png" alt="Imagen de la publicacion">
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
        
        <button class="toTop" id="toTop">
          <svg viewBox="0 0 24 24">
          <path d="m4 16 8-8 8 8"></path>
          </svg>
        </button>

        <script src="../js/scriptedituser.js"></script>