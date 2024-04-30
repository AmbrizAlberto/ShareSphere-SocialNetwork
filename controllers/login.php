<?php
namespace controllers;
require_once('../autoload.php');
use Models\{posts,conexion};
use PDO, PDOException;
$posts = new posts();
session_set_cookie_params(0);
    session_start();// Iniciar la sesión
    if(isset($_SESSION['email']))
    {
        header("Location:../src/views/main.php");
    }
?>

<?php


$conn = new conexion();

$pdo = $conn->getPdo();


// Verifica si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['email']) && isset($_POST['password'])) 
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            // Preparamos la consulta para obtener el usuario por su email
            $consulta = $pdo->prepare("SELECT firstname , lastname, nickname,id, password FROM users WHERE email = :email");
            $consulta->bindParam(':email', $email);
            $consulta->execute();
            $user = $consulta->fetch(PDO::FETCH_ASSOC);

            if ($user) 
            {
                // Verificamos si la contraseña ingresada coincide con la almacenada en la base de datos
                if (password_verify($password, $user['password']))
                {
                    $_SESSION['email'] = $email; // Almacenamos el email del usuario en la sesión
                    $_SESSION['firstname'] = $user['firstname']; // Almacenamos el nombre del usuario en la sesión
                    $_SESSION['lastname'] = $user['lastname'];
                    $_SESSION['nickname'] = $user['nickname'];  // Almacenamos el nickname en la sesión
                    $_SESSION['userId'] = $user['id']; // Almacenamos el id del usuario en la sesión
                    $_SESSION['theme'] = $posts->GetTheme($_SESSION['userId']);
                    header("Location:../src/views/main.php"); // Redireccionar al usuario a la página de inicio
                    exit();
                } else 
                {
                    echo "<script>alert('Los datos ingresados son incorrectos.'); window.history.back();</script>";
                }
            } else 
            {
                echo "<script>alert('El correo electrónico no está registrado.'); window.location.href = '../src/views/login.php';</script>";
            }
        } catch (PDOException $e) 
        {
            // En caso de error, muestra un mensaje de error
            $errorMessage = addslashes($e->getMessage());
            echo "<script>
                alert('Error de registro: " . $errorMessage . "');
                window.location.href = '../src/views/login.php';
            </script>";
        }
    } 
    else 
    {
        echo "No se enviaron los datos del formulario.";
    }
    
}
?>
