<?php
namespace models;
use PDO, PDOException;

/**
 * Class Response
 * 
 * Represents a response in the forum.
 */
class Response {
    private $conn;
    private $table_name = "Response";

    // Object properties
    private $id;
    private $content;
    private $image;
    private $createdAt;
    private $updatedAt;
    private $creatorId;
    private $commentId;

    /**
     * Response constructor.
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

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = htmlspecialchars(strip_tags($content));
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

    public function getCommentId() {
        return $this->commentId;
    }

    public function setCommentId($commentId) {
        $this->commentId = htmlspecialchars(strip_tags($commentId));
    }

    // CRUD methods
    public function create() {
        // Query to insert a record
        $query = "INSERT INTO " . $this->table_name . " SET content=:content, image=:image, creatorId=:creatorId, commentId=:commentId";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":creatorId", $this->creatorId);
        $stmt->bindParam(":commentId", $this->commentId);

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
        $query = "UPDATE " . $this->table_name . " SET content=:content, image=:image, creatorId=:creatorId, commentId=:commentId WHERE id=:id";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":creatorId", $this->creatorId);
        $stmt->bindParam(":commentId", $this->commentId);
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
