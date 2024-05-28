<!DOCTYPE html>
<?php
require_once ("../../autoload.php");
use Models\{posts};

$posts = new posts();
$postList = $posts->GetPosts();

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

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ShareSphere</title>

  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../css/mainVisit.css">
  <link rel="stylesheet" href="../css/textpost.css">
  <link rel="stylesheet" href="../css/photopost.css">
  <link rel="stylesheet" href="../css/filtros.css">
  <link rel="stylesheet" href="../css/modal.css">
  <link rel="stylesheet" href="../css/Post.css">
  <link rel="stylesheet" href="../css/modalEdit.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="icon" href="../images/Logo-cut.png" type="image/png">

</head>

<body>
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

    <br /><br /><br /><br /><br />

    <div class="filtros">
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
      <?php $username = $posts->GetUserById(filter_var($post['creatorId'], FILTER_SANITIZE_STRING)); ?>

      <!-- CONTENEDOR POST -->
      <div class="post-container" onclick="openPostModal(<?php echo $post['id']; ?>)">
        <!-- INFO USUARIO -->
        <div class="user-info">
          <a href="<?php echo "/src/views/visitorUserPage.php?idPerfil=" . $post['creatorId']; ?>"> <img
              src="<?php echo "/public/images_users/" . $posts->GetUserImgById($post['creatorId']) ?>"
              alt="User Image"></a>
          <span><?php echo $username['username'] ?></span>
        </div>
       
        <h2 class="post-content">
          <?php echo $post['title']; ?>
        </h2>
        <a style=text-decoration:none>
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

        <div class="description">
          <?php echo $post['content'] ?>
        </div>
        <div class="image-container">
          <?php if ($post['image'] != null) { ?>
            <img src="/public/images_posts/<?php echo $post['image'] ?>" alt="Imagen de la publicacion">
          <?php } ?>
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

    <button class="toTop" id="toTop">
      <svg viewBox="0 0 24 24">
        <path d="m4 16 8-8 8 8"></path>
      </svg>
    </button>

  <script src="../js/script.js"></script>
  <script src="../js/scriptedit.js"></script>
  <script src="../js/toTop.js"></script>
  <script src="../js/light-darkMode.js"></script>
  <script src="../js/post.js"></script>
</body>

</html>