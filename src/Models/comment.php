<?php
namespace models;
use PDO, PDOException;

/**
 * The Comment class represents a comment in the system.
 */
class Comment {
    private $conn;
    private $table_name = "Comment";

    // Object properties
    private $id;
    private $content;
    private $image;
    private $createdAt;
    private $updatedAt;
    private $creatorId;
    private $postId;
    private $replyToId;

    /**
     * Constructor for the Comment class.
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

    public function getPostId() {
        return $this->postId;
    }

    public function setPostId($postId) {
        $this->postId = htmlspecialchars(strip_tags($postId));
    }

    public function getReplyToId() {
        return $this->replyToId;
    }

    public function setReplyToId($replyToId) {
        $this->replyToId = htmlspecialchars(strip_tags($replyToId));
    }

    // CRUD methods
    public function create() {
        // Query to insert a record
        $query = "INSERT INTO " . $this->table_name . " SET content=:content, image=:image, creatorId=:creatorId, postId=:postId, replyToId=:replyToId";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":creatorId", $this->creatorId);
        $stmt->bindParam(":postId", $this->postId);
        $stmt->bindParam(":replyToId", $this->replyToId);

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
        $query = "UPDATE " . $this->table_name . " SET content=:content, image=:image, creatorId=:creatorId, postId=:postId, replyToId=:replyToId WHERE id=:id";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":creatorId", $this->creatorId);
        $stmt->bindParam(":postId", $this->postId);
        $stmt->bindParam(":replyToId", $this->replyToId);
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
