<?php
    namespace controllers;
    require_once("../../autoload.php");
    use Models\posts;
    $post = new posts();
    if(!isset($_POST['post_title']) or !isset($_POST['post_content']) or !isset($_POST['id']) or !isset($_POST['post_subgroup_id'])){
        error_log("Error: No se han recibido los datos necesarios");
        header("location:/src/views/main.php");
    } else {
        $title = filter_var($_POST['post_title'], FILTER_SANITIZE_STRING);
        $content = filter_var($_POST['post_content'], FILTER_SANITIZE_STRING);
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $subgroup_id = filter_var($_POST['post_subgroup_id'], FILTER_SANITIZE_NUMBER_INT);

        if($_FILES['newImage']['error'] == 0 && !empty($_FILES['newImage']['name'])){
            $post->EditPost($id,$title, $content, $subgroup_id, $_FILES['newImage']['name']);
        }else{
            $post->EditPost($id,$title, $content, $subgroup_id, null);
        }

        if($_POST['currentPage'] == 0){
            header("location:/src/views/main.php");
        }else if($_POST['currentPage'] == 1){
            header("location:/src/views/PerfilPage.php");
        }else if($_POST['currentPage'] == 2){
            header("location:/src/views/admin.php");
        }
    }
?>