<?php
namespace controllers;
    require_once("../../autoload.php");
    use Models\posts;
    $post = new posts();   
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $post->DeletePost($id);
}else{
    console_log("Error: No se ha recibido el id del post a eliminar");  
}
header( $_GET['page'] == 0 ? "location:/src/views/main.php" : "location:/src/views/PerfilPage.php");
?>