<?php
session_start();
session_unset();
session_destroy();
header('Location:../src/views/login.php');
?>