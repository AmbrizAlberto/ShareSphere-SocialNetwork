<?php
namespace controllers;

require_once ("../../autoload.php");
session_start();
use Models\posts;

$post = new posts();
$parts = explode("/", $_GET['CurrentPage']);
$part = end($parts);
$page = explode(".", $part)[0];
$_SESSION['theme'] = ($_SESSION['theme'] === '0') ? '1' : '0';
$post->UpdateTheme(filter_var($_SESSION['userId']), filter_var($_SESSION['theme']), FILTER_SANITIZE_NUMBER_INT);

if ($page == "main") {
    header("location:/src/views/main.php");
} else {
    header("location:/src/views/PerfilPage.php");
}
?>