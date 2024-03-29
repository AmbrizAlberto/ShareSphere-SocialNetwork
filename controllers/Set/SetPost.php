<?php
    namespace controllers;
    require_once("../../autoload.php");
    use Models\posts;
    $post = new posts();
    if(!isset($_POST['post_title']) or !isset($_POST['post_content']) or !isset($_POST['post_creator_id']) or !isset($_POST['post_subgroup_id'])){
        error_log("Error: No se han recibido los datos necesarios");
        header("location:/src/views/main.php");
    } else {
        $title = filter_var($_POST['post_title'], FILTER_SANITIZE_STRING);
        $content = filter_var($_POST['post_content'], FILTER_SANITIZE_STRING);
        $creator_id = filter_var($_POST['post_creator_id'], FILTER_SANITIZE_NUMBER_INT);
        $subgroup_id = filter_var($_POST['post_subgroup_id'], FILTER_SANITIZE_NUMBER_INT);
        
        if($_FILES['image']['error'] == 0){
            $name_images= $post->GetPathImg();
            $path_img = $post->InsertImg($name_images, $title);
            $id = $post->InsertPost($title, $content, $path_img, $creator_id, $subgroup_id);
            error_log("Se ha insertado el post con id: $id");
            header("location:/src/views/main.php");
        }else{
            $id = $post->InsertPost($title, $content, null, $creator_id, $subgroup_id);
            error_log("Se ha insertado el post con id: $id sin imagen");
            header("location:/src/views/main.php");
        }
    }
?>