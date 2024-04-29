<?php
    namespace controllers;
    require_once("../../autoload.php");
    use Models\posts;
    $post = new posts();
    if(!isset($_POST['userId']) or !isset($_POST['newUsername']) or !isset($_POST['newDescription'])){
        error_log("Error: No se han recibido los datos necesarios");
        header("location:/src/views/PerfilPage.php");
    } else {
        $username = filter_var($_POST['newUsername'], FILTER_SANITIZE_STRING);
        $idUser = filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT);
        $description = filter_var($_POST['newDescription'], FILTER_SANITIZE_STRING);
        
        if($_FILES['newImage']['error'] == 0 && !empty($_FILES['newImage']['name'])){ 
            $post->UpdateUser($idUser, $username, $description, $_FILES['newImage']['name']);
            error_log("Se ha insertado el post con id: $idUser");
            header("location:/src/views/PerfilPage.php");
        }else{
            $id = $post->InsertPost($title, $content, null, $creator_id, $subgroup_id);
            error_log("Se ha insertado el post con id: $id sin imagen");
            header("location:/src/views/main.php");
        }
    }
?>