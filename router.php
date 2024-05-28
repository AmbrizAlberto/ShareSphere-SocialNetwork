<?php
// router.php

// Obtener la solicitud de la URL
$request = $_SERVER['REQUEST_URI'];

// Eliminar los parámetros de la consulta (query string)
$request = parse_url($request, PHP_URL_PATH);

// Definir la ruta base del directorio de documentos
$docRoot = __DIR__;

// Verificar si la solicitud es para un archivo estático (CSS, JS, imágenes, etc.)
if (preg_match('/\.(?:css|js|png|jpg|jpeg|gif|ico)$/', $request)) {
    return false; // Dejar que el servidor web embebido maneje estos archivos directamente
}

// Ruta a archivo .php correspondiente
$file = $docRoot . $request . '.php';

// Verificar si el archivo existe
if (file_exists($file)) {
    include $file;
} else {
    http_response_code(404);
    echo "404 Not Found";
}