<?php
session_start();
require_once ("../../autoload.php");
use Models\{posts};

$posts = new posts();
$postList = $posts->GetPostsByIdUser($_SESSION['userId']);
$user = $posts->GetUserById($_SESSION['userId']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ShareSphere</title>

  <link rel="stylesheet" href="<?php echo '../css/main.css'//$user['theme'] =='0' ?  '../css/light-mode.css':  '../css/main.css' ?>" id="theme-style">
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../css/textpost.css">
  <link rel="stylesheet" href="../css/photopost.css">
  <link rel="stylesheet" href="../css/PerfilPage.css">
  <link rel="stylesheet" href="../css/modal.css">
  <link rel="stylesheet" href="../css/modalEdit.css">
  <link rel="stylesheet" href="../css/filtros.css">
  <link rel="stylesheet" href="../css/Post.css">


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
        <input type="image"
          src="<?php echo $user['image'] ? "/public/images_users/" . $user['image'] : "/public/images_users/userdefault.png" ?>"
          alt="Texto Alternativo">
      </form>

      <button id="modalBtn" style="background-color: transparent;">
        <i class="bi bi-plus-square"></i>
      </button>
      <div id="myModal" class="modal">
        <div class="modal-content">
          <span class="close" id="closeBtn">&times;</span>
          <form action="/controllers/Set/SetPost.php" method="post" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $_SESSION['userId']; ?>" name="post_creator_id">
            <input type="hidden" value="1" name="currentPage">
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

      <button style="background-color: transparent;">
        <i class="bi bi-app-indicator"></i>
      </button>

      <a href="../../controllers/logout.php" class="logout"><i class="bi bi-box-arrow-right"></i></a>

      <button id="theme-toggle-btn"><i class="bi bi-lightbulb-fill"></i></button>
      
    </div>


    <div class="PerfilPage">

      <div class="PerfilDatos">
        <div class="PerfilPortada">
          <img
            src="<?php echo $user['coverImg'] ? "/public/fondo_users/" . $user['coverImg'] : "/public/fondo_users/fondodefault.png" ?>"
            alt="#" style="height: auto; wight: 300;">
          <button id="modalBtnEdit" type="button" class="editbtn">
            <i class="bi bi-pencil-fill"></i> Editar
          </button>
        </div>

        <div class="PerfilPhoto">
          <img
            src="<?php echo $user['image'] ? "/public/images_users/" . $user['image'] : "/public/images_users/userdefault.png" ?>"
            alt="">
        </div>
        <div class="PerfilName">
          <h1><?php echo $user['username'] ?></h1>
        </div>
        <div class="PerfilDescription">
          <h2><?php echo $user['descripcion'] ? $user['descripcion'] : "Sin descripcion" ?></h2>
        </div>
      </div>

    </div>

    <div id="Modal-Profile" class="modaledit">
      <div class="modal-content-edit">
        <span class="close-edit">&times;</span>
        <h2>Editar Perfil</h2>
        <form id="editForm" action="/controllers/Edit/EditUser.php" method="post" enctype="multipart/form-data">
          <label for="newUsername">Nombre de Usuario:</label><br>
          <input type="text" id="newUsername" name="newUsername" value="<?php echo $user['username'] ?>"><br><br>

          <label for="newDescription">Descripción:</label><br>
          <textarea id="newDescription" name="newDescription" rows="4"
            cols="50"><?php echo $user['descripcion'] ?></textarea><br><br>

          <input type="hidden" value="<?php echo $_SESSION['userId']; ?>" name="userId">
          <label for="newImage">Cargar imagen de perfil:</label><br>
          <input type="file" id="newImage" name="newImage" accept="image/*"><br><br>
          <label for="imagePortada">Cargar imagen de portada:</label><br>
          <input type="file" id="imagePortada" name="imagePortada" accept="image/*"><br><br>
          <img id="previewImage" src="<?php echo "/public/images_users/" . $user['image'] ?>" alt="User Image" class=".modal-content-edit">



          <button class=".modal-content-edit" type="submit" value="Guardar cambios">Guardar</button>
        </form>
      </div>
    </div>

    <div class="filtros" style="position: absolute;">
      <div class="containerfiltros">
        <h1>Filtro</h1>

        <div class="forum">
          <button onclick="window.location.href='../views/foro_6.php'"><img src="../images/6.png"></button>
          <button onclick="window.location.href='../views/foro_7.php'"><img src="../images/7.png"></button>
          <button onclick="window.location.href='../views/foro_14.php'"><img src="../images/14.jpg"></button>
        </div>

      </div>
    </div>


    <?php foreach ($postList as $post) { ?>
      <div class="post-container">
        <div class="post-options">
          <span><i class="bi bi-caret-down-fill"></i></span>
          <div class="option-content">
            <a id="modalBtn-edit" onclick="openmodal('<?php echo htmlspecialchars(json_encode($post), ENT_QUOTES, 'UTF-8');?>')"><i class="bi bi-pencil-fill"></i></a>
            <a href="/controllers/Delete/DeletePost.php?id=<?php echo $post['id'] ?>&page=1"><i
                class="bi bi-trash-fill"></i></a>
          </div>
        </div>
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
        <?php if ($post['image'] != null) { ?>
        <div class="image-container">
          <img src="<?php echo "/public/images_posts/" . $post['image'] ?>" alt="Imagen de la publicacion">
        </div>
        <?php } ?>
        <div class="post-actions">
          <button class="action-btn"><i class="bi bi-hand-thumbs-up-fill"> 200</i></button>
          <button class="action-btn"><i class="bi bi-hand-thumbs-down-fill"> 200</i></button>
          <button class="action-btn"><i class="bi bi-chat-square-text-fill"> 200</i></button>
        </div>
      </div>
    <?php } ?>

    <div id="Post-complete" class="post">
      <span class="close-post" onclick="closeModal()">&times;</span>
      <div class="content-post">
        <img id="fullImage">
      </div>
      <div id="comment">
        <div class="text-comment">
          <input type="comment" placeholder="Comenta...">
        </div>
        <div class="box-comment">
          <div class="user-info-post">
            <a href="../views/PerfilPage.php"><img src="../images/Uli.png" alt="User Image"></a>
            <span><?php echo $username['username'] ?></span>
          </div>
          <div class="description-comment">
            <h2>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro quam, perspiciatis sit ipsum voluptatum
              provident accusamus dolores dolorem ex numquam et magnam fugit praesentium, sapiente nemo culpa quisquam,
              consectetur corporis.</h2>
          </div>
        </div>
        <div class="box-comment">
          <div class="user-info-post">
            <a href="../views/PerfilPage.php"><img src="../images/Uli.png" alt="User Image"></a>
            <span><?php echo $username['username'] ?></span>
          </div>
          <div class="description-comment">
            <h2>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro quam, perspiciatis sit ipsum voluptatum
              provident accusamus dolores dolorem ex numquam et magnam fugit praesentium, sapiente nemo culpa quisquam,
              consectetur corporis.</h2>
          </div>
        </div>
      </div>
    </div>

    <div id="myModal-edit" class="modal">
        <div class="modal-content">
          <span class="close" id="closeBtn-edit" >&times;</span>
          <form id="editForm" action="/controllers/Edit/EditPost.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="idPost" name="id">
            <input type="hidden" value="1" name="currentPage">
            <label for="tema">Tema:</label>
            <select id="selector-edit" name="post_subgroup_id" required>
              <option value="1" >Agua Limpia y Saneamineto</option>
              <option value="3" >Energia Asequible y No Contaminante</option>
              <option value="4" >Vida Submarina</option>
              <!-- Agrega más opciones según sea necesario -->
            </select>
            <label for="titulo-edit">Titulo:</label>
            <textarea id="titulo-edit" name="post_title" rows="1" required placeholder="Titulo..."></textarea>

            <label for="texto-edit">Texto:</label>
            <textarea id="texto-edit" name="post_content" rows="4" requiredplaceholder="Descripcion..."></textarea>
            <label for="newImage-edit">Cargar imagen:</label><br>
            <img id="previewImage-edit"  class=".modal-content">
            <input type="file" id="newImage-edit" name="newImage" accept="image/*">
            <button class=".modal-content" type="submit">Guardar Cambios</button>
          </form>
        </div>
        </div>

    <button class="toTop" id="toTop">
      <svg viewBox="0 0 24 24">
        <path d="m4 16 8-8 8 8"></path>
      </svg>
    </button>

    <script src="../js/scriptedituser.js"></script>
    <script src="../js/toTop.js"></script>
    <script src="../js/light-darkMode.js"></script>
    <script src="../js/post.js"></script>
    <script src="../js/editpost.js"></script>