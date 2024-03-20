<?php
namespace models;
use PDO, PDOException;

/**
 * The Votes class represents a vote in the system.
 */
class Votes {
    private $conn;
    private $table_name = "Vote";

    // Object properties
    private $id;
    private $type;
    private $userId;
    private $postId;
    private $commentId;

    /**
     * Constructor for the Votes class.
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

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = htmlspecialchars(strip_tags($type));
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = htmlspecialchars(strip_tags($userId));
    }

    public function getPostId() {
        return $this->postId;
    }

    public function setPostId($postId) {
        $this->postId = htmlspecialchars(strip_tags($postId));
    }

    public function getCommentId() {
        return $this->commentId;
    }

    public function setCommentId($commentId) {
        $this->commentId = htmlspecialchars(strip_tags($commentId));
    }

    // Insert a new vote
    public function insertVote() {
        // Query to insert a vote
        $query = "INSERT INTO " . $this->table_name . " (type, userId, postId, commentId) VALUES (:type, :userId, :postId, :commentId)";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":postId", $this->postId);
        $stmt->bindParam(":commentId", $this->commentId);

        // Execute the query
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }

        return false;
    }

    // Get votes by post ID
    public function getVotesByPostId($postId) {
        // Query to count votes for a post
        $query = "SELECT COUNT(*) as votes FROM " . $this->table_name . " WHERE postId = :postId";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind value
        $stmt->bindParam(":postId", $postId);

        // Execute the query
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get votes by comment ID
    public function getVotesByCommentId($commentId) {
        // Query to count votes for a comment
        $query = "SELECT COUNT(*) as votes FROM " . $this->table_name . " WHERE commentId = :commentId";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind value
        $stmt->bindParam(":commentId", $commentId);

        // Execute the query
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
