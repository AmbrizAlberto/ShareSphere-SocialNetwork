
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


</body>
</html>