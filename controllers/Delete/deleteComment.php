<?php
namespace controllers;

require_once ("../../autoload.php");
use Models\posts;

$post = new posts();
if (isset($_GET['id'])) {
    $post->DeleteCommentById($_GET['id']);
} else {
    console_log("Error: No se ha recibido el id del comentario a eliminar");
}
header("location:/src/views/".$_GET['from'].".php");

?>