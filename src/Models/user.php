<?php
namespace models;
use PDO, PDOException;

/**
 * The User class represents a user in the system.
 */
class User {
    private $conn;
    private $table_name = "User";

    // Object properties
    private $id;
    private $name;
    private $email;
    private $emailVerified;
    private $username;
    private $passwordHash;
    private $image;

    /**
     * Constructor for the User class.
     * 
     * @param PDO $db The database connection.
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    // Getters and setters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = htmlspecialchars(strip_tags($name));
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = htmlspecialchars(strip_tags($email));
    }

    public function getEmailVerified() {
        return $this->emailVerified;
    }

    public function setEmailVerified($emailVerified) {
        $this->emailVerified = htmlspecialchars(strip_tags($emailVerified));
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = htmlspecialchars(strip_tags($username));
    }

    public function getPasswordHash() {
        return $this->passwordHash;
    }

    public function setPasswordHash($passwordHash) {
        $this->passwordHash = password_hash(htmlspecialchars(strip_tags($passwordHash)), PASSWORD_BCRYPT);
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = htmlspecialchars(strip_tags($image));
    }

    // CRUD methods
    public function create() {
        // Query to insert a record
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, email=:email, username=:username, passwordHash=:passwordHash, image=:image";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":passwordHash", $this->passwordHash);
        $stmt->bindParam(":image", $this->image);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read() {
        // Query to select all records
        $query = "SELECT * FROM " . $this->table_name;

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Execute the query
        $stmt->execute();

        return $stmt;
    }

    public function update() {
        // Query to update a record
        $query = "UPDATE " . $this->table_name . " SET name=:name, email=:email, username=:username, passwordHash=:passwordHash, image=:image WHERE id=:id";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":passwordHash", $this->passwordHash);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":id", $this->id);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        // Query to delete a record
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind the id of the record to delete
        $stmt->bindParam(":id", $this->id);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function verifyPassword($password) {
        return password_verify($password, $this->passwordHash);
    }
}
?>
