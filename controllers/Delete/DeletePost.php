<?php
namespace controllers;
    require_once("../../autoload.php");
    use Models\posts;
    $post = new posts();

if(isset($_GET['id'])){
    $post->DeletePost($_GET['id']);
    header("location:/src/views/main.php");
}else{
    header("location:/src/views/main.php");
}
?>