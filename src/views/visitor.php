
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
    <link rel="stylesheet" href="../css/mainVisit.css">
    <link rel="stylesheet" href="../css/textpost.css">
    <link rel="stylesheet" href="../css/photopost.css">
    <link rel="stylesheet" href="../css/filtros.css">
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
            <button class="optionnv" href="/"><i class="bi bi-rocket-takeoff"></i><span>Popular</span></button>
            <button class="optionnv" href="/about"><i class="bi bi-controller"></i><span>Gaming</span></button>
            <button class="optionnv" href="/about"><i class="bi bi-dribbble"></i><span>Sports</span></button>
            <br />
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

          <a href="./login.php" class="logout">Logout<i class="bi bi-box-arrow-in-right"></i></a>

        </div>

        <br /><br /><br /><br /><br /><br />


        <div class="upload">
          <form action="#" method="post">
            <input type="text" class="uploadtext" placeholder="¿Qué estás pensando?" />
            <button class="button">Upload</button>
          </form>
        </div>

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
        <div class="Post">
  
          <div class="leftside">
  
            <div class="postheader">

              <div class="themename">
                <h1><?php echo $post['title'] ?></h1>
              </div>
              
              <div class="user">
                <div class="photouser">
                  <form action="#" method="post">
                    <input
                      type="image"
                      src="https://img.freepik.com/foto-gratis/joven-barbudo-camisa-rayas_273609-5677.jpg?w=740&t=st=1702678697~exp=1702679297~hmac=c54395be72f5a4c41e214867636a5cc62b7244b9da21862a94571399b52a2953"
                      alt="Texto Alternativo"/>
                  </form>
                </div>

                <div class="postdatos">
                  <div class="name">
                    <h1><?php echo $username['username'] ?></h1>
                  </div>
                </div>
                
              </div>
            </div>
  
            <div class="photopost">
              <?php if($post['image'] != null){ ?>
                <img src="/public/images_posts/<?php echo $post['image'] ?>" alt="Imagen de la publicacion">
              <?php } ?>
              
              <div class="RLC">
                <div class="resumen">
                  <p>10,000 Likes</p>
                  <p>10,000 Comentarios</p>
                </div>
                <div class="reactions">
                  <button className="btn btn-primary"><i class="bi bi-star"></i></button>
                  <button className="btn btn-secondary"><i class="bi bi-chat"></i></button>
                </div>
              </div>
              
            </div>
  
          </div>
  
          <div class="rightside">
            <div class="description">
                <h1>DESCRIPTION</h1>
                <h1><?php echo $post['content'] ?></h1>
              </div>
          </div>
          
  
        </div>

        <?php } ?>





        

      </div>

</body>
</html>