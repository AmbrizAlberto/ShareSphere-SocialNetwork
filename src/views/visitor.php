<!DOCTYPE html>
<?php
require_once ("../../autoload.php");
use Models\{posts};

$posts = new posts();
$postList = $posts->GetPosts();
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

  <link rel="stylesheet" href="../css/main.css" id="theme-style-visitor">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="icon" href="../images/Logo-cut.png" type="image/png">

</head>

<body>
  <div class="main">

    <div class="feedhead">
      <h1>ShareSphere</h1>
      <div class="search-nav">
        <form action="#" method="get">
          <input type="text" placeholder="Buscar..." name="search">
        </form>
      </div>
      <a href="/src/views/login.php" class="logout"><i class="bi bi-box-arrow-in-left"> Iniciar Sesion</i></a>
      <!-- Cerramos la sesion -->

      <button id="theme-toggle-btn-visitor"><i class="bi bi-lightbulb-fill"></i></button>

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

      <div class="post-container">
        <div class="user-info">
          <a href="<?php echo "/src/views/visitorUserPage.php?idPerfil=" . $post['creatorId']; ?>"> <img
              src="<?php echo "/public/images_users/" . $posts->GetUserImgById($post['creatorId']) ?>"
              alt="User Image"></a>
          <span><?php echo $username['username'] ?></span>
        </div>
        <div class="post-options">
          <span><i class="bi bi-caret-down-fill"></i></span>
        </div>
        <h2 class="post-content">
          <?php echo $post['title']; ?>
        </h2>
        <a href="#" style=text-decoration:none>
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
            <img src="/public/images_posts/<?php echo $post['image'] ?>" alt="Imagen de la publicacion"
              onclick="openModal(event)">
          <?php } ?>
        </div>
        <div class="post-actions">
          <button class="action-btn"><i class="bi bi-hand-thumbs-up-fill"> 200</i></button>
          <button class="action-btn"><i class="bi bi-hand-thumbs-down-fill">200</i></button>
          <button class="action-btn"><i class="bi bi-chat-square-text-fill"></i></button>
        </div>
      </div>
    <?php } ?>

    <div id="Post-complete" class="post">
      <span class="close-post" onclick="closeModal()">&times;</span>
      <img class="content-post" id="fullImage">
      <div id="comment">
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

      <div id="comment">
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




    <button class="toTop" id="toTop">
      <svg viewBox="0 0 24 24">
        <path d="m4 16 8-8 8 8"></path>
      </svg>
    </button>

    <script src="../js/script.js"></script>
    <script src="../js/scriptedit.js"></script>
    <script src="../js/toTop.js"></script>
    <script src="../js/post.js"></script>
</body>

</html>