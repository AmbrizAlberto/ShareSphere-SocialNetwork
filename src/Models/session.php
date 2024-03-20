<?php
namespace models;
use PDO, PDOException;

/**
 * The Session class represents a session in the application.
 */
class Session {
    private $conn;
    private $table_name = "Session";

    // Object properties
    private $id;
    private $userId;
    private $expires;
    private $sessionToken;
    private $accessToken;
    private $createdAt;
    private $updatedAt;

    /**
     * Constructor for the Session class.
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

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = htmlspecialchars(strip_tags($userId));
    }

    public function getExpires() {
        return $this->expires;
    }

    public function setExpires($expires) {
        $this->expires = htmlspecialchars(strip_tags($expires));
    }

    public function getSessionToken() {
        return $this->sessionToken;
    }

    public function setSessionToken($sessionToken) {
        $this->sessionToken = htmlspecialchars(strip_tags($sessionToken));
    }

    public function getAccessToken() {
        return $this->accessToken;
    }

    public function setAccessToken($accessToken) {
        $this->accessToken = htmlspecialchars(strip_tags($accessToken));
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    // CRUD methods
    public function create() {
        // Query to insert a record
        $query = "INSERT INTO " . $this->table_name . " SET userId=:userId, expires=:expires, sessionToken=:sessionToken, accessToken=:accessToken, createdAt=:createdAt, updatedAt=:updatedAt";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":expires", $this->expires);
        $stmt->bindParam(":sessionToken", $this->sessionToken);
        $stmt->bindParam(":accessToken", $this->accessToken);
        $stmt->bindParam(":createdAt", $this->createdAt);
        $stmt->bindParam(":updatedAt", $this->updatedAt);

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
        $query = "UPDATE " . $this->table_name . " SET userId=:userId, expires=:expires, sessionToken=:sessionToken, accessToken=:accessToken, createdAt=:createdAt, updatedAt=:updatedAt WHERE id=:id";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":expires", $this->expires);
        $stmt->bindParam(":sessionToken", $this->sessionToken);
        $stmt->bindParam(":accessToken", $this->accessToken);
        $stmt->bindParam(":createdAt", $this->createdAt);
        $stmt->bindParam(":updatedAt", $this->updatedAt);
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
}
?>
