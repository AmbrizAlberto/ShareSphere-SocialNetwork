<?php
spl_autoload_register(function ($class_name) {
    $url = str_replace("\\", "/", 'src/' . $class_name . '.php');
    require_once ($url);
});
?>