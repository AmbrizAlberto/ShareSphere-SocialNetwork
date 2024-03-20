<?php
namespace models;
use PDO, PDOException;

/**
 * Class Subgroup
 * 
 * Represents a subgroup in the application.
 */
class Subgroup {
    private $conn;
    private $table_name = "Subgroup";

    // Object properties
    private $id;
    private $name;
    private $description;
    private $image;
    private $createdAt;
    private $updatedAt;
    private $creatorId;

    /**
     * Constructor with database connection.
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

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = htmlspecialchars(strip_tags($description));
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = htmlspecialchars(strip_tags($image));
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function getCreatorId() {
        return $this->creatorId;
    }

    public function setCreatorId($creatorId) {
        $this->creatorId = htmlspecialchars(strip_tags($creatorId));
    }

    // CRUD methods
    public function create() {
        // Query to insert a record
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, description=:description, image=:image, creatorId=:creatorId";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":creatorId", $this->creatorId);

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
        $query = "UPDATE " . $this->table_name . " SET name=:name, description=:description, image=:image, creatorId=:creatorId WHERE id=:id";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":creatorId", $this->creatorId);
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