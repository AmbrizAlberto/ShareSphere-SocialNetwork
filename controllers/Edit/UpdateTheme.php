<?php
// UpdateTheme.php
namespace controllers;

require_once ("../../autoload.php");
session_start();
use Models\posts;

$post = new posts();
$_SESSION['theme'] = ($_SESSION['theme'] === '0') ? '1' : '0';
$post->UpdateTheme(filter_var($_SESSION['userId']), filter_var($_SESSION['theme']), FILTER_SANITIZE_NUMBER_INT);
header("Location:".$_GET['CurrentPage']);
?>