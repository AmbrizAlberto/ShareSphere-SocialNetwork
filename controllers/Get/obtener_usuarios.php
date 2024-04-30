<?php
require_once "../../autoload.php";
use models\users;

// Instancia de la clase de usuarios
$usersModel = new users();

// Obtener la lista de usuarios
$listaUsuarios = $usersModel->GetListaUsuarios();

// Devolver la lista de usuarios en formato JSON
echo json_encode($listaUsuarios);
?>
