<?php
namespace controllers;

require_once('../autoload.php');
use Models\{posts, conexion};
use PDO, PDOException;

$posts = new posts();
session_set_cookie_params(0);
session_start(); // Iniciar la sesión

if (isset($_SESSION['email'])) {
    header("Location: ../src/views/main.php");
    exit();
}

$conn = new conexion();
$pdo = $conn->getPdo();

// Verifica si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $admincode = $_POST['code-admin'];

        try {
            // Preparamos la consulta para obtener el usuario por su email
            $consulta = $pdo->prepare("SELECT name, username, id, passwordHash, theme, admin_code, admin FROM user WHERE email = :email");
            $consulta->bindParam(':email', $email);
            $consulta->execute();
            $user = $consulta->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Verificamos si la contraseña ingresada coincide con la almacenada en la base de datos
                if (password_verify($password, $user['passwordHash'])) {
                    $_SESSION['email'] = $email; // Almacenamos el email del usuario en la sesión
                    $_SESSION['name'] = $user['name']; // Almacenamos el nombre del usuario en la sesión
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['userId'] = $user['id']; // Almacenamos el id del usuario en la sesión
                    $_SESSION['theme'] = $user['theme'];
                    $_SESSION['admin'] = $user['admin']; // Almacenamos el valor actual de admin en la sesión

                    if ($admincode == $user['admin_code']) {
                        // Actualizamos el valor de admin a 1
                        $update = $pdo->prepare("UPDATE user SET admin = 1 WHERE id = :id");
                        $update->bindParam(':id', $user['id']);
                        $update->execute();
                        $_SESSION['admin'] = 1; // Actualizamos el valor de admin en la sesión
                        header("Location: ../src/views/admin.php"); // Redireccionar al usuario a la página de admin
                        exit();
                    } else {
                        header("Location: ../src/views/main.php"); // Redireccionar al usuario a la página principal
                        exit();
                    }
                } else {
                    echo "<script>alert('Los datos ingresados son incorrectos.'); window.history.back();</script>";
                }
            } else {
                echo "<script>alert('El correo electrónico no está registrado.'); window.location.href = '../src/views/login.php';</script>";
            }
        } catch (PDOException $e) {
            // En caso de error, muestra un mensaje de error
            $errorMessage = addslashes($e->getMessage());
            echo "<script>
                alert('Error de registro: " . $errorMessage . "');
                window.location.href = '../src/views/login.php';
            </script>";
        }
    } else {
        echo "No se enviaron los datos del formulario.";
    }
}
?>
