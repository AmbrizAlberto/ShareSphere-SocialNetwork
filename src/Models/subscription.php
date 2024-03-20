<?php
namespace models;
use PDO, PDOException;

/**
 * Class Subscription
 * 
 * Represents a subscription in the system.
 */
class Subscription {
    private $conn;
    private $table_name = "Subscription";

    // Object properties
    private $userId;
    private $subgroupId;
    private $createdAt;
    private $updatedAt;

    /**
     * Constructor with the database connection.
     * 
     * @param PDO $db The database connection.
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    // Getters and setters
    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = htmlspecialchars(strip_tags($userId));
    }

    public function getSubgroupId() {
        return $this->subgroupId;
    }

    public function setSubgroupId($subgroupId) {
        $this->subgroupId = htmlspecialchars(strip_tags($subgroupId));
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
        $query = "INSERT INTO " . $this->table_name . " SET userId=:userId, subgroupId=:subgroupId";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":subgroupId", $this->subgroupId);

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
        $query = "UPDATE " . $this->table_name . " SET userId=:userId, subgroupId=:subgroupId WHERE userId=:userId AND subgroupId=:subgroupId";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":subgroupId", $this->subgroupId);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        // Query to delete a record
        $query = "DELETE FROM " . $this->table_name . " WHERE userId=:userId AND subgroupId=:subgroupId";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":subgroupId", $this->subgroupId);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
