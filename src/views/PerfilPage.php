<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShareSphere</title>

    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/textpost.css">
    <link rel="stylesheet" href="../css/photopost.css">
    <link rel="stylesheet" href="../css/PerfilPage.css">
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
                <form>
                  <label for="tema">Tema:</label>
                  <select id="selector" name="selector">
                    <option value="opcion1">Opción 1</option>
                    <option value="opcion2">Opción 2</option>
                    <option value="opcion3">Opción 3</option>
                    <!-- Agrega más opciones según sea necesario -->
                </select>
          
                  <label for="texto">Texto:</label>
                  <textarea id="texto" name="texto" rows="4" required></textarea>
          
                  <label for="foto">Foto:</label>
                  <input type="file" id="foto" name="foto" accept="image/*">
          
                  <button type="button" onclick="submitForm()">Enviar</button>
              </form>
              </div>
            </div>
            <script src="script.js"></script>
            
            <button>
              <i class="bi bi-app-indicator"></i>
            </button>

            <a href="../../controllers/logout.php" class="logout"><i class="bi bi-box-arrow-right"></i></a>
          </div>


          <div class="PerfilPage">

            <div class="PerfilDatos">
                <div class="PerfilPortada">
                    <img src="https://i.pinimg.com/736x/b3/08/cc/b308cc852be780b03a9873ef42ce71f5.jpg" alt="#">
                    <button id="modalBtnEdit" type="button" class="editbtn">
                        <i class="bi bi-pencil-fill"></i> Editar
                    </button>
                </div>
        
                <div class="PerfilPhoto">
                    <img src="https://img.freepik.com/foto-gratis/joven-barbudo-camisa-rayas_273609-5677.jpg?w=740&t=st=1702678697~exp=1702679297~hmac=c54395be72f5a4c41e214867636a5cc62b7244b9da21862a94571399b52a2953" alt="">
                </div>
                <div class="PerfilName">
                    <h1>Name</h1>
                </div>
                <div class="PerfilDescription">
                    <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, dolorum. Illo aut iure sapiente ex a eaque, vitae eum laudantium quibusdam at consequatur ab magnam soluta, sequi aliquid accusantium saepe.</h2>
                </div>
            </div>
        
        </div>
        
        <!-- El modal -->
        <div id="myModalEdit" class="modaledit">
            <!-- Contenido del modal -->
            <div class="modal-content-edit">
                <span class="close-edit">&times;</span>
                <h2>Editar Perfil</h2>
                <form id="editForm">
                    <label for="newImage">Cargar nueva imagen:</label><br>
                    <input type="file" id="newImage" name="newImage"><br><br>
                    <label for="newUsername">Nombre de Usuario:</label><br>
                    <input type="text" id="newUsername" name="newUsername"><br><br>
                    <label for="newDescription">Descripción:</label><br>
                    <textarea id="newDescription" name="newDescription" rows="4" cols="50"></textarea><br><br>
                    <button class=".modal-content-edit " type="submit" value="Guardar cambios">Guardar</button> 
                </form>
            </div>
        </div>
        <script src="scriptedituser.js"></script>

        <div class="Post">
  
            <div class="leftside">
    
              <div class="postheader">
  
                <div class="themename">
                  <h1>Theme</h1>
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
                      <h1>Name</h1>
                    </div>
                    <div class="options">
                      <button class="btn btn-light" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots-vertical"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-pencil-fill"></i> Editar</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-trash-fill"></i> Eliminar</a></li>
                      </ul>
                    </div>
                  </div>
                  
                </div>
              </div>
    
              <div class="textpost">
                
                <div class="texto">
                  <h1>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam, aperiam consequatur quis dolorum, vitae adipisci vel excepturi quas rerum sint molestias molestiae. Beatae minus a id. Iure harum molestias doloribus?</h1>
                </div>
  
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
  
    
          </div>
  
  
  
  
          <div class="Post">
    
            <div class="leftside">
    
              <div class="postheader">
  
                <div class="themename">
                  <h1>Theme</h1>
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
                      <h1>Name</h1>
                    </div>
                    <div class="options">
                      <button class="btn btn-light" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots-vertical"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-pencil-fill"></i> Editar</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-trash-fill"></i> Eliminar</a></li>
                      </ul>
                    </div>
                  </div>
                  
                </div>
              </div>
    
              <div class="photopost">
                <img src="https://i.pinimg.com/originals/d1/46/c6/d146c6f891e3464d5544d15eaaff7661.jpg" alt="#" />
                
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
                <h1>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptates quam laboriosam repudiandae ad numquam itaque magni alias non saepe, ducimus, enim voluptas cumque a quidem est veritatis aperiam quod velit.</h1>                </div>
            </div>