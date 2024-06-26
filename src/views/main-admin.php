<?php
// Función para evitar que los usuarios sin sesión iniciada puedan acceder al main
session_start(); // Iniciar la sesión
if (empty($_SESSION['email'])) {
    header("Location:./login.php");
    exit();
}

require_once ("../../autoload.php");
use Models\posts;

$posts = new posts();
$postList = $posts->GetPosts();
$userdata = $posts->GetUserById($_SESSION['userId']);
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

// Definir la función para obtener la URL de la vista de cada subgrupo
function getSubgroupViewUrl($subgroupId) {
  switch ($subgroupId) {
    case '1':
      return "#";
    case '3':
      return "#";
    case '4':
      return "#";
    default:
      return "#"; // URL por defecto si no se encuentra un subtema específico
  }
}
?>


<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ShareSphere</title>

  <!-- CSS -->
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/textpost.css">
  <link rel="stylesheet" href="../css/photopost.css">
  <link rel="stylesheet" href="../css/filtros.css">
  <link rel="stylesheet" href="../css/modal.css">
  <link rel="stylesheet" href="../css/Post.css">
  <link rel="stylesheet" href="../css/modalEdit.css">

  <link rel="stylesheet" href="../css/ResponsiveMain.css">
  <link rel="stylesheet" href="../css/ResponsiveModal.css">


  <!-- CSS TEMAS -->
  <link rel="stylesheet" href="<?php echo $userdata['theme'] == '0' ? '../css/light-mode.css' : '../css/main.css' ?>"
    id="theme-style">

  <!-- IMPORTACION DE TOOLS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link rel="icon" href="../images/Logo-cut.png" type="image/png">

</head>

<body>

  <!-- NAVBAR -->
  <header>
    <div class="navbar">
      <div class="access">
        <!-- ACCESOS -->
        <a href="./admin.php"><button class="optionnv"><i class="bi bi-house-fill"></i></i><span>Home</span></button></a>
      </div>
    </div>
  </header>

  <div class="main">

    <!-- HEADER MAIN -->
    <div class="feedhead">

      <div class="logo">
        <a href="./main-admin.php"><img src="../images/Logo-cut.png" alt="Logo"></a>
      </div>

      <button id="theme-toggle-btn">
        <i class="bi bi-lightbulb-fill"></i>
      </button>

      <!-- NOMBRE DE PAGINA -->
      <a href="./main-admin.php" class="ShSp">
        <h1 href="./main-admin.php">ShareSphere</h1>
      </a>

      <!-- BUSCADOR -->
      <div class="search-nav">
          <form action="#" method="get">
              <input type="text" placeholder="Buscar..." name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search'], ENT_QUOTES) : ''; ?>">
          </form>
      </div>

      <!-- FOTO DE PERFIL -->
      <form action="./admin.php" method="post">
        <input type="image"
          src="<?php echo $userdata['image'] ? "/public/images_users/" . $userdata['image'] : "/public/images_users/userdefault.png" ?>"
          alt="Texto Alternativo" />
      </form>  
      
    </div>

    <br /><br /><br /><br /><br /><br />

    <!-- PUBLICACIONES -->
    <?php foreach ($postList as $post) { ?>
      <?php
      $username = $posts->GetUserById(filter_var($post['creatorId'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $editpost = $post;
      ?>
      
      <!-- CONTENEDOR POST -->
      <div class="post-container" onclick="openPostModal(<?php echo $post['id']; ?>)">
        <!-- INFO USUARIO -->
        <div class="user-info">
          <a href="#">
            <img src="<?php echo "/public/images_users/" . $posts->GetUserById($post['creatorId'])['image']; ?>" />
          </a>
          <span><?php echo $username['username'] ?></span>
        </div>

        <!-- OPCIONES DE POST -->
        
        <div class="post-options">
          <span><i class="bi bi-caret-down-fill"></i></span>
          <div class="option-content">
            <!-- ELIMINAR POST -->
            <a href="/controllers/Delete/DeletePost.php?id=<?php echo $post['id'] ?>&page=0">
              <i class="bi bi-trash-fill"></i></a>
          </div>
        </div>
        

        <!-- TITULO POST -->
        <h2 class="post-content">
          <?php echo $post['title']; ?>
        </h2>

        <!-- SUBTITULO POST-->
        <a href="<?php echo getSubgroupViewUrl($post['SubgroupId']); ?>" style="text-decoration:none;">
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
        </a>


        <!-- DESCRIPCION POST -->
        <div class="description">
          <?php echo $post['content'] ?>
        </div>
        <div class="image-container">
          <?php if ($post['image'] != null) { ?>
            <img src="/public/images_posts/<?php echo $post['image'] ?>" alt="Imagen de la publicacion">
          <?php } ?>
        </div>

        <div class="post-actions">
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
  <script src="../js/toTop.js"></script>
  <script src="../js/light-darkMode.js"></script>
  <script src="../js/post.js"></script>
</body>

</html>