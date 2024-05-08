<?php
session_start();// Iniciar la sesión
if (empty($_SESSION['email'])) {
  header("Location:./login.php");

}

?>

<!DOCTYPE html>
<?php
require_once ("../../autoload.php");
use Models\{posts};

$posts = new posts();
$postList = $posts->GetPosts();
$userdata = $posts->GetUserById($_SESSION['userId']);
?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ShareSphere</title>

  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/textpost.css">
  <link rel="stylesheet" href="../css/photopost.css">
  <link rel="stylesheet" href="../css/filtros.css">
  <link rel="stylesheet" href="../css/modal.css">
  <link rel="stylesheet" href="../css/Post.css">
  <link rel="stylesheet" href="../css/modalEdit.css">

  <link rel="stylesheet" href="<?php echo $userdata['theme'] == '0' ? '../css/light-mode.css' : '../css/main.css' ?>"
    id="theme-style">

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
        <button class="optionnv" href="#"><i class="bi bi-house-fill"></i></i><span>Home</span></button>
        <a href="./PerfilPage.php"><button class="optionnv"><i
              class="bi bi-person-circle"></i></i><span>Profile</span></button></a>
      </div>

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
          src="<?php echo $userdata['image'] ? "/public/images_users/" . $userdata['image'] : "/public/images_users/userdefault.png" ?>"
          alt="Texto Alternativo" />
      </form>
      <button id="modalBtn" style="background-color: transparent;">
        <i class="bi bi-plus-square"></i>
      </button>
      <div id="myModal" class="modal">
        <div class="modal-content">
          <span class="close" id="closeBtn">&times;</span>
          <form action="/controllers/Set/SetPost.php" method="post" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $_SESSION['userId']; ?>" name="post_creator_id">
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
            <textarea id="texto" name="post_content" rows="4" requiredplaceholder="Descripcion..."></textarea>

            <label for="foto">Imagen:</label>
            <input type="file" id="foto" name="image" accept="image/*">

            <button type="submit">Enviar</button>
          </form>
        </div>
      </div>
      <script src="script.js"></script>

      <button style="background-color: transparent;">
        <i class="bi bi-app-indicator"></i>
      </button>

      <a href="../../controllers/logout.php" class="logout"><i class="bi bi-box-arrow-right"></i></a>

      <button id="theme-toggle-btn"><i class="bi bi-lightbulb-fill"></i></button>

    </div>

    <br /><br /><br /><br /><br /><br />

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
          <a
            href="<?php echo "/src/views/" . ($_SESSION['userId'] == $post['creatorId'] ? "PerfilPage.php" : "userPage.php?idPerfil=" . $post['creatorId']); ?>">
            <img src="<?php echo "/public/images_users/" . $posts->GetUserImgById($post['creatorId']) ?>"
              alt="User Image"></a>
          <span><?php echo $username['username'] ?></span>
        </div>
        <div class="post-options">
          <span><i class="bi bi-caret-down-fill"></i></span>
          <?php if ($post['creatorId'] == $_SESSION['userId']) { ?>
            <div class="option-content">
              <a><i class="bi bi-pencil-fill"></i></a>
              <a href="/controllers/Delete/DeletePost.php?id=<?php echo $post['id'] ?>&page=0"><i
                  class="bi bi-trash-fill"></i></a>
            </div>
          <?php } ?>
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
      
      <div class="box-descripcion">
        <div class="user-info-post">
          <a href="../views/PerfilPage.php"><img src="../images/Uli.png" alt="User Image"></a>
          <span><?php echo $username['username'] ?></span>
        </div>
        <h2>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro quam, perspiciatis sit ipsum voluptatum
            provident accusamus dolores dolorem ex numquam et magnam fugit praesentium, sapiente nemo culpa quisquam,
            consectetur corporis.
        </h2>
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