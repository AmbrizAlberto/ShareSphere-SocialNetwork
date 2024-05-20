<?php
    namespace controllers;
    require_once("../../autoload.php");
    use Models\posts;
    $post = new posts();
    if(!isset($_POST['userId']) or !isset($_POST['newUsername']) or !isset($_POST['newDescription'])){
        error_log("Error: No se han recibido los datos necesarios");
    } else {
        $username = filter_var($_POST['newUsername'], FILTER_SANITIZE_STRING);
        $idUser = filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT);
        $description = filter_var($_POST['newDescription'], FILTER_SANITIZE_STRING);
        
        if($_FILES['newImage']['error'] == 0 && !empty($_FILES['newImage']['name'])){ 
            if($_FILES['imagePortada']['error'] == 0 && !empty($_FILES['imagePortada']['name'])){
                $post->UpdateUser($idUser, $username, $description, $_FILES['newImage']['name'], $_FILES['imagePortada']['name']);
            }else{
            $post->UpdateUser($idUser, $username, $description, $_FILES['newImage']['name']);
            error_log("Se ha insertado el post con id: $idUser");
            }
        }else{
            if($_FILES['imagePortada']['error'] == 0 && !empty($_FILES['imagePortada']['name'])){
                $post->UpdateUser($idUser, $username, $description, null, $_FILES['imagePortada']['name']);
            }else{
            $post->UpdateUser($idUser, $username, $description, null, null);
            error_log("Se ha insertado el post con id: $id sin cambiar la imagen");
            }
        }
    }
    header("location:/src/views/PerfilPage.php");
?>