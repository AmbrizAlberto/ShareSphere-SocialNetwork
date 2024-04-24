
<!DOCTYPE html>
<?php
require_once("../../autoload.php");
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
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/textpost.css">
    <link rel="stylesheet" href="../css/photopost.css">
    <link rel="stylesheet" href="../css/filtros.css">
    <link rel="stylesheet" href="../css/modal.css">
    <link rel="stylesheet" href="../css/modalEdit.css">
    
    <link rel="stylesheet" href="../css/light-mode.css" id="theme-style"> 

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
            <button class="optionnv" href="#"><i class="bi bi-house-fill"></i></i><span>Home</span></button>
            <a href="./PerfilPage.php"><button class="optionnv"><i class="bi bi-person-circle"></i></i><span>Profile</span></button></a>
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
              <form action="/controllers/Set/SetPost.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="post_creator_id" value="1">
                <label for="tema">Tema:</label>
                <select id="selector" name="post_subgroup_id" required>
                  <option value="1">6 Agua Limpia y Saneamineto</option>
                  <option value="2">7 Energia Asequible y No Contaminante</option>
                  <option value="3">14 Vida Submarina</option>
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
          
          <button>
            <i class="bi bi-app-indicator"></i>
          </button>

          <a href="../../controllers/logout.php" class="logout"><i class="bi bi-box-arrow-right"></i></a>

        </div>

        <br /><br /><br /><br /><br /><br />


        <div class="upload">
          <form action="#" method="post">
            <input type="text" class="uploadtext" placeholder="¿Qué estás pensando?" />
            <button class="button">Upload</button>
          </form>
        </div>

        <button id="theme-toggle-btn"><i class="bi bi-lightbulb-fill"></i></button>

        <div class="filtros">
          <div class="containerfiltros">
            <h1>Filtro</h1>

            <div class="forum">
              <button><img src="../images/6.png"></button>
              <button><img src="../images/7.png"></button>
              <button><img src="../images/14.jpg"></button>
            </div>

          </div>
        </div>

        <?php foreach($postList as $post){?>
          <?php $username = $posts->GetUserById(filter_var($post['creatorId'], FILTER_SANITIZE_STRING));?>
          
          <div class="post-container">
            <div class="user-info">
              <img src="../images/Uli.png" alt="User Image">
              <span><?php echo $username['username']?></span>
            </div>
            <div class="post-options">
              <button class="action-btn"><i class="bi bi-three-dots"></i></i></button>
            </div>
            <h2 class="post-content">
              <?php echo $post['title'];  ?>
            </h2>
            <h3 class="SubTitle">
              Tema de la onu
            </h3>
            <div class="description">
              <?php echo $post['content'] ?>
            </div>
            <div class="image-container">
              <?php if($post['image'] != null){ ?>
                <img src="/public/images_posts/<?php echo $post['image'] ?>" alt="Imagen de la publicacion">
              <?php } ?>
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
        
        <script src="scriptedit.js"></script>
        <script src="toTop.js"></script>
        <script src="light-darkMode.js"></script>
</body>
</html>