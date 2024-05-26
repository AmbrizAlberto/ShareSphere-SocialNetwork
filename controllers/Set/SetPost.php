<?php
// SetPost.php
namespace controllers;

require_once ("../../autoload.php");
use Models\posts;

$post = new posts();

// Verificar que se hayan recibido los datos necesarios
if (!isset($_POST['post_title']) || !isset($_POST['post_content']) || !isset($_POST['post_creator_id']) || !isset($_POST['post_subgroup_id'])) {
    error_log("Error: No se han recibido los datos necesarios");
    header("location:/src/views/main.php");
    exit();
}

// Sanitizar y validar datos de entrada
$title = filter_var($_POST['post_title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$content = filter_var($_POST['post_content'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$creator_id = filter_var($_POST['post_creator_id'], FILTER_SANITIZE_NUMBER_INT);
$subgroup_id = filter_var($_POST['post_subgroup_id'], FILTER_SANITIZE_NUMBER_INT);

// Definir longitudes máximas
$maxTitleLength = 255; // Ajusta según tu definición de base de datos
$maxContentLength = 10000; // Ajusta según tu definición de base de datos

// Verificar longitud del título y contenido
if (strlen($title) > $maxTitleLength) {
    error_log("Error: El título es demasiado largo");
    header("location:/src/views/main.php");
    exit();
}

if (strlen($content) > $maxContentLength) {
    error_log("Error: El contenido es demasiado largo");
    header("location:/src/views/main.php");
    exit();
}

if ($_FILES['image']['error'] == 0) {
    $name_images = $post->GetPathImg();
    $path_img = $post->InsertImg($name_images, $title);
    $id = $post->InsertPost($title, $content, $path_img, $creator_id, $subgroup_id);
    error_log("Se ha insertado el post con id: $id");
} else {
    $id = $post->InsertPost($title, $content, null, $creator_id, $subgroup_id);
    error_log("Se ha insertado el post con id: $id sin imagen");
}

// Redireccionar según la página actual
switch ($_POST['currentPage']) {
    case 0:
        header("location:/src/views/main.php");
        break;
    case 1:
        header("location:/src/views/PerfilPage.php");
        break;
    case 2:
        header("location:/src/views/admin.php");
        break;
    case 3:
        header("location:/src/views/foro_6.php");
        break;
    case 4:
        header("location:/src/views/foro_7.php");
        break;
    case 5:
        header("location:/src/views/foro_14.php");
        break;
    default:
        header("location:/src/views/main.php");
        break;
}
exit();
?>
