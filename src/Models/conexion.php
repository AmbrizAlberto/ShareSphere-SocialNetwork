<?php
namespace Models;
use PDO, PDOException;
// Definimos los datos de conexión
define('DB_HOST', 'localhost'); // El nombre del servidor
define('DB_USER', 'root'); // El nombre de usuario
define('DB_PASS', ''); // La contraseña
define('DB_NAME', 'forumdb'); // El nombre de la base de datos

// Creamos una clase para manejar la conexión
class Conexion {
    // Declaramos una propiedad para almacenar el objeto PDO
    private $pdo;

    // El constructor de la clase
    public function __construct() {
        // Intentamos establecer la conexión
        try {
            // Creamos el objeto PDO con los datos de conexión
            $this->pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
            // Configuramos el modo de error a excepciones
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Conexión exitosa"; // Agregamos un mensaje para verificar la conexión
        } catch (PDOException $e) {
            // En caso de error, mostramos un mensaje y terminamos la ejecución
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // Un método para obtener el objeto PDO
    public function getPdo() {
        return $this->pdo;
    }
}

// Creamos una instancia de la clase








/*class Conexion {
    private $servername = "localhost";
    private $username = "root"; 
    private $password = ""; 
    private $dbname = "proyecto4"; 

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    public function getConexion() {
        return $this->conn;
    }
}*/
?>