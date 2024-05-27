<?php
session_start();
require_once ("../../autoload.php");
use Models\{posts};

$posts = new posts();
$postList = $posts->GetPostsByIdUser($_SESSION['userId']);
$user = $posts->GetUserById($_SESSION['userId']);
$notifications = $posts->GetNotifications($_SESSION['userId']);
$hasNotifications = !empty($notifications);

// Filtrar publicaciones basadas en el término de búsqueda
if (isset($_GET['search'])) {
  $searchTerm = filter_var($_GET['search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $postList = array_filter($postList, function($post) use ($searchTerm) {
        // Buscar en el título, subtítulo (SubgroupId), y contenido
        $titleMatch = stripos($post['title'], $searchTerm) !== false;
        $contentMatch = stripos($post['content'], $searchTerm) !== false;
        $subgroupMatch = false;
        switch ($post['SubgroupId']) {
            case '1':
                $subgroupMatch = stripos("Agua Limpia y Saneamiento", $searchTerm) !== false;
                break;
            case '3':
                $subgroupMatch = stripos("Energia Asequible y No Contaminante", $searchTerm) !== false;
                break;
            case '4':
                $subgroupMatch = stripos("Vida Submarina", $searchTerm) !== false;
                break;
        }
        return $titleMatch || $contentMatch || $subgroupMatch;
    });
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ShareSphere</title>

  <link rel="stylesheet"
    href="<?php echo '../css/main.css'//$user['theme'] =='0' ?  '../css/light-mode.css':  '../css/main.css' ?>"
    id="theme-style">
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../css/textpost.css">
  <link rel="stylesheet" href="../css/photopost.css">
  <link rel="stylesheet" href="../css/PerfilPage.css">
  <link rel="stylesheet" href="../css/modal.css">
  <link rel="stylesheet" href="../css/modalEdit.css">
  <link rel="stylesheet" href="../css/filtros.css">
  <link rel="stylesheet" href="../css/Post.css">

  <link rel="stylesheet" href="<?php echo $userdata['theme'] == '0' ? '../css/light-mode.css' : '../css/main.css' ?>"
    id="theme-style">

  <link rel="stylesheet" href="../css/ResponsivePerfilPage.css">
  <link rel="stylesheet" href="../css/ResponsiveMain.css">
  <link rel="stylesheet" href="../css/ResponsiveModal.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="icon" href="../images/Logo-cut.png" type="image/png">

</head>

<body>
  <header>
  <div class="navbar">
      <div class="access">
        <!-- ACCESOS -->
        <a href="./main.php"><button class="optionnv"><i class="bi bi-house-fill"></i></i><span>Home</span></button></a>
        <a href="#"><button class="optionnv"><i class="bi bi-person-circle"></i></i><span>Profile</span></button></a>
      </div>
  </div>
  </header>

  <div class="main">
    <div class="feedhead">

      <div class="logo">
        <a href="./main.php"><img src="../images/Logo-cut.png" alt="Logo"></a>
      </div>

      <button id="theme-toggle-btn">
        <i class="bi bi-lightbulb-fill"></i>
      </button>

      <a href="./main.php" class="ShSp">
        <h1 href="./main.php">ShareSphere</h1>
      </a>

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

      <!-- NOTIFICACIONES -->

      <button id="notificaciones-btn" onclick="toggleMenu()">
        <i class="bi bi-app-indicator"></i>
      </button>
      <div id="notificaciones-menu" class="notificaciones-menu <?php echo $hasNotifications ? '' : 'hidden'; ?>">
        <!-- Contenido del menú de notificaciones -->
        <?php if ($hasNotifications) { ?>
          <?php foreach ($notifications as $notification) { ?>
            <div class="notificacion">
              <div class="contenido">
                <p><?php echo $notification['content']; ?></p>
                <p><?php echo $notification['date_created']; ?></p>
                <button class="delete-notification-btn" data-id="<?php echo $notification['id']; ?>">Eliminar</button>
              </div>
            </div>
          <?php } ?>
        <?php } else { ?>
          <p>No hay notificaciones.</p>
        <?php } ?>
      </div>      
      
      <!-- CERRAR SESION -->
      <a href="../../controllers/logout.php" class="logout"><i class="bi bi-box-arrow-right"></i></a>

    </div>

    <div class="PerfilPage">

        <div class="PerfilPortada">
          <img src="<?php echo $user['coverImg'] ? "/public/fondo_users/" . $user['coverImg'] : "/public/fondo_users/fondodefault.png" ?>" alt="#" style="height: auto;">
          
          <button id="modalBtnEdit" type="button" class="editbtn">
            <i class="bi bi-pencil-fill"></i> Editar
          </button>
        </div>

        <div class="PerfilPhoto">
          <img
            src="<?php echo $user['image'] ? "/public/images_users/" . $user['image'] : "/public/images_users/userdefault.png" ?>" alt="">
        </div>

        <div class="PerfilName">
          <h1><?php echo $user['username'] ?></h1>
        </div>

        <div class="PerfilDescription">
          <h2><?php echo $user['descripcion'] ? $user['descripcion'] : "Sin descripcion" ?></h2>
        </div>

    </div>

    <div id="Modal-Profile" class="modaledit">
      <div class="modal-content-edit">
        <span class="close-edit">&times;</span>
        <h2>Editar Perfil</h2>
        <form id="editForm" action="/controllers/Edit/EditUser.php" method="post" enctype="multipart/form-data">
          <label for="newUsername">Nombre de Usuario:</label>
          <p><input type="text" id="newUsername" name="newUsername" value="<?php echo $user['username'] ?>"></p>

          <label for="newDescription">Descripción:</label>
          <p><textarea id="newDescription" name="newDescription" rows="4"
            cols="50"><?php echo $user['descripcion'] ?></textarea></p>

          <input type="hidden" value="<?php echo $_SESSION['userId']; ?>" name="userId">
          <label for="newImage">Cargar imagen de perfil:</label>
          <p><input type="file" id="newImage" name="newImage" accept="image/*"></p>
          <label for="imagePortada">Cargar imagen de portada:</label>
          <p><input type="file" id="imagePortada" name="imagePortada" accept="image/*"></p>
          <p><img id="previewImage" src="<?php echo "/public/images_users/" . $user['image'] ?>" alt="User Image"
            class=".modal-content-edit"></p>



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
      <!-- CONTENEDOR POST -->
      <div class="post-container" onclick="openPostModal(<?php echo $post['id']; ?>)">
         <!-- OPCIONES DE POST -->
         <?php if ($post['creatorId'] == $_SESSION['userId']) { ?>
        <div class="post-options">
          <span><i class="bi bi-caret-down-fill"></i></span>
          <div class="option-content">
            <!-- EDITAR POST -->
            <a id="modalBtn-edit" onclick="openmodal('<?php echo addslashes(htmlspecialchars(json_encode($post), ENT_QUOTES, 'UTF-8')); ?>', event)">
              <i class="bi bi-pencil-fill"></i>
            </a>
            <!-- ELIMINAR POST -->
            <a href="/controllers/Delete/DeletePost.php?id=<?php echo $post['id'] ?>&page=0">
              <i class="bi bi-trash-fill"></i></a>
          </div>
        </div>
        <?php } ?>
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
          <!-- Like -->
          <button class="action-btn like-button" data-post-id="<?php echo $post['id']; ?>">
            <i class="bi bi-hand-thumbs-up-fill"></i>
            <span id="like-count-<?php echo $post['id']; ?>"><?php echo $posts->GetLikesCount($post['id']); ?></span>
          </button>
          <!-- Comentarios -->
          <button class="action-btn" onclick="openPostModal(<?php echo $post['id']; ?>)">
            <i class="bi bi-chat-square-text-fill"></i>
            <span id="comment-count-<?php echo $post['id']; ?>"><?php echo $posts->GetCommentsCount($post['id']); ?></span>
          </button>
        </div>
      </div>
    <?php } ?>
    

    <!-- MODAL AL ENTRAR AL POST -->
    <div id="postModal" class="post-modal">
        <div class="post-content1">
            <span class="close-post" onclick="closePostModal()">&times;</span>
            <div id="postModalContent" class="post-description"></div>
        </div>
        <div class="post-comments">
            <!-- Aquí se colocará el contenido de los comentarios y el formulario de nuevo comentario -->
        </div>
    </div>
  </div>

  <!-- MODAL DE EDITAR POST -->
  <div id="myModal-edit" class="modal">
    <div class="modal-content">
      <span class="close" id="closeBtn-edit">&times;</span>
      <form id="editForm" action="/controllers/Edit/EditPost.php" method="post" enctype="multipart/form-data">
        <input type="hidden" id="idPost" name="id">
        <input type="hidden" value="0" name="currentPage">
        <label for="tema">Tema:</label>
        <select id="selector-edit" name="post_subgroup_id" required>
          <option value="1">Agua Limpia y Saneamineto</option>
          <option value="3">Energia Asequible y No Contaminante</option>
          <option value="4">Vida Submarina</option>
          <!-- Agrega más opciones según sea necesario -->
        </select>
        <label for="titulo-edit">Titulo:</label>
        <textarea id="titulo-edit" name="post_title" rows="1" required placeholder="Titulo..."></textarea>

        <label for="texto-edit">Texto:</label>
        <textarea id="texto-edit" name="post_content" rows="4" requiredplaceholder="Descripcion..."></textarea>
        <label for="newImage-edit">Cargar imagen:</label>
        <p><img id="previewImage-edit" class=".modal-content" style="align-content: center;display: flex;"></p>
        <input type="file" id="newImage-edit" name="newImage" accept="image/*">
        <button class=".modal-content" type="submit">Guardar Cambios</button>
      </form>
    </div>
  </div>

  <!-- BOTON A TOP -->
  <button class="toTop" id="toTop">
    <svg viewBox="0 0 24 24">
      <path d="m4 16 8-8 8 8"></path>
    </svg>
  </button>

  <!-- SCRIPTS -->
  <script src="../js/Notifications.js"></script>
  <script src="../js/NotificationsDEL.js"></script>
  <script src="../js/Likes.js"></script>
  <script src="../js/script.js"></script>
  <script src="../js/scriptedit.js"></script>
  <script src="../js/toTop.js"></script>
  <script src="../js/light-darkMode.js"></script>
  <script src="../js/post.js"></script>
  <script src="../js/editpost.js"></script>