<?php
namespace controllers;
    require_once("../../autoload.php");
    use Models\posts;
    $post = new posts();   
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $post->DeletePostsByAdmin($id);
    $post->DeletePost($id);
}else{
    console_log("Error: No se ha recibido el id del post a eliminar");  
}
if($_GET['page'] == 0){
    header("location:/src/views/main.php");
}else if($_GET['page']== 1){
    header("location:/src/views/userPage.php");
}else if($_GET['page']== 2){
    header("location:/src/views/admin.php");
}
?>