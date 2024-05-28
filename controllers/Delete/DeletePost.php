<?php
namespace controllers;

require_once ("../../autoload.php");
use Models\posts;

$post = new posts();
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $post->DeletePost($id);
} else {
    console_log("Error: No se ha recibido el id del post a eliminar");
}

if ($_GET['page'] == 0) {
    header("location:/src/views/main.php");
} else if ($_GET['page'] == 1) {
    header("location:/src/views/PerfilPage.php");
} else if ($_GET['page'] == 2) {
    header("location:/src/views/admin.php");
}else if ($_GET['page'] == 3) {
    header("location:/src/views/foro_6.php");
}else if ($_GET['page'] == 4) {
    header("location:/src/views/foro_7.php");
}else if ($_GET['page'] == 5) {
    header("location:/src/views/foro_14.php");
}else if ($_GET['page'] == 6) {
    header("location:/src/views/userPage.php?idPerfil=".$_GET['idPerfil']);
}
?>