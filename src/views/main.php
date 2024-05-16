<?php //Funcion para evitar que los usuarios sin sesion iniciada puedan acceder al main
    session_start();// Iniciar la sesión
    if(empty($_SESSION['email']))
    {
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

</head>

<body>

  <!-- NAVBAR -->
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
        <!-- ACCESOS -->
        <button class="optionnv" href="#"><i class="bi bi-house-fill"></i></i><span>Home</span></button>
        <a href="./PerfilPage.php"><button class="optionnv"><i
              class="bi bi-person-circle"></i></i><span>Profile</span></button>
        </a>
      </div>

    </div>
  </header>

  <div class="main">

    <!-- HEADER MAIN -->
    <div class="feedhead">
      <button id="theme-toggle-btn">
        <i class="bi bi-lightbulb-fill"></i>
      </button>
      <!-- NOMBRE DE PAGINA -->
      <h1>ShareSphere</h1>
      
      <!-- BUSCADOR -->
      <div class="search-nav">
        <form action="#" method="get">
          <input type="text" placeholder="Buscar..." name="search">
        </form>
      </div>
      <!-- FOTO DE PERFIL -->
      <form action="./PerfilPage.php" method="post">
        <input type="image"
          src="<?php echo $userdata['image'] ? "/public/images_users/" . $userdata['image'] : "/public/images_users/userdefault.png" ?>"
          alt="Texto Alternativo" />
      </form>

      <!-- BOTON CREAR POST -->
      <button id="modalBtn" style="background-color: transparent;">
        <i class="bi bi-plus-square"></i>
      </button>
      <!-- MODAL CREAR POST -->
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
            <label for="titulo">Titulo:</label>
            <textarea id="titulo" name="post_title" rows="1" required placeholder="Titulo..."></textarea>
            <label for="texto">Texto:</label>
            <textarea id="texto" name="post_content" rows="4" requiredplaceholder="Descripcion..."></textarea>
            <label for="foto">Imagen:</label>
            <input type="file" id="foto" name="image" accept="image/*">
            <button type="submit">Enviar</button>
          </form>
        </div>
      </div>
      <script src="script.js"></script>

      <!-- NOTIFICACIONES -->
      <button style="background-color: transparent;">
        <i class="bi bi-app-indicator"></i>
      </button>
      <!-- CERRAR SESION -->
      <a href="../../controllers/logout.php" class="logout"><i class="bi bi-box-arrow-right"></i></a>

    </div>

   <br/><br/><br/><br/><br/><br/>


    <!-- FILTROS CONTENEDOR -->
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

    <!-- PUBLICACIONES -->
    <?php foreach ($postList as $post) { ?>
      <?php $username = $posts->GetUserById(filter_var($post['creatorId'], FILTER_SANITIZE_STRING));
      $editpost = $post; ?>

      <!-- CONTENEDOR POST -->
      <div class="post-container">
        <!-- INFO USUARIO -->
        <div class="user-info" onclick="openModal(event)">
          <a
            href="<?php echo "/src/views/" . ($_SESSION['userId'] == $post['creatorId'] ? "PerfilPage.php" : "userPage.php?idPerfil=" . $post['creatorId']); ?>">
            <img src="<?php echo "/public/images_users/" . $posts->GetUserImgById($post['creatorId']) ?>"
              alt="User Image"></a>
          <span><?php echo $username['username'] ?></span>
        </div>
        
        <!-- OPCIONES DE POST -->
        <div class="post-options">
          <span><i class="bi bi-caret-down-fill"></i></span>
          <?php if ($post['creatorId'] == $_SESSION['userId']) { ?>
            <div class="option-content">
            <!-- EDITAR POST -->
            <a id="modalBtn-edit" onclick="openmodal('<?php echo htmlspecialchars(json_encode($post), ENT_QUOTES, 'UTF-8');?>')">
              <i class="bi bi-pencil-fill"></i>
            </a>
            <!-- ELIMINAR POST -->
            <a href="/controllers/Delete/DeletePost.php?id=<?php echo $post['id'] ?>&page=0">
              <i class="bi bi-trash-fill"></i></a>
            </div>
          <?php } ?>
        </div>
        <!-- TITULO POST -->
        <h2 class="post-content" onclick="openModal(event)">
          <?php echo $post['title']; ?>
        </h2>
        <!-- SUBTITULO POST-->
        <a href="#" style=text-decoration:none>
          <h3 class="SubTitle" onclick="openModal(event)">
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
        <div class="description" onclick="openModal(event)">
          <?php echo $post['content'] ?>
        </div>
        <div class="image-container" onclick="openModal(event)">
          <?php if ($post['image'] != null) { ?>
            <img src="/public/images_posts/<?php echo $post['image'] ?>" alt="Imagen de la publicacion">
          <?php } ?>
        </div>
        <div class="post-actions">
          <button class="action-btn"><i class="bi bi-hand-thumbs-up-fill"> 200</i></button>
          <button class="action-btn"><i class="bi bi-hand-thumbs-down-fill"> 200</i></button>
          <button class="action-btn" onclick="openModal(event)"><i class="bi bi-chat-square-text-fill"> 200</i></button>
        </div>
      </div>
    <?php } ?>



    <!-- MODAL AL ENTRAR AL POST -->
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
            <span><?php echo $username['username'] ?></span>s
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



  <!-- MODAL DE EDITAR POST -->
  <div id="myModal-edit" class="modal">
        <div class="modal-content">
          <span class="close" id="closeBtn-edit" >&times;</span>
          <form id="editForm" action="/controllers/Edit/EditPost.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="idPost" name="id">
            <input type="hidden" value="0" name="currentPage">
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
            <img id="previewImage-edit"   class=".modal-content">
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
  <script src="../js/script.js"></script>
  <script src="../js/scriptedit.js"></script>
  <script src="../js/toTop.js"></script>
  <script src="../js/light-darkMode.js"></script>
  <script src="../js/post.js"></script>
  <script src="../js/editpost.js"></script>
</body>

</html>