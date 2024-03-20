<?php
namespace models;
use PDO, PDOException;

/**
 * The Account class represents a user account.
 */
class Account {
    private $conn;
    private $table_name = "Account";

    // Object properties
    private $id;
    private $userId;
    private $type;
    private $provider;
    private $providerAccountId;
    private $refresh_token;
    private $access_token;
    private $expires_at;
    private $token_type;
    private $scope;
    private $id_token;
    private $session_state;

    /**
     * Constructor for the Account class.
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

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = htmlspecialchars(strip_tags($type));
    }

    public function getProvider() {
        return $this->provider;
    }

    public function setProvider($provider) {
        $this->provider = htmlspecialchars(strip_tags($provider));
    }

    public function getProviderAccountId() {
        return $this->providerAccountId;
    }

    public function setProviderAccountId($providerAccountId) {
        $this->providerAccountId = htmlspecialchars(strip_tags($providerAccountId));
    }

    public function getRefreshToken() {
        return $this->refresh_token;
    }

    public function setRefreshToken($refresh_token) {
        $this->refresh_token = htmlspecialchars(strip_tags($refresh_token));
    }

    public function getAccessToken() {
        return $this->access_token;
    }

    public function setAccessToken($access_token) {
        $this->access_token = htmlspecialchars(strip_tags($access_token));
    }

    public function getExpiresAt() {
        return $this->expires_at;
    }

    public function setExpiresAt($expires_at) {
        $this->expires_at = htmlspecialchars(strip_tags($expires_at));
    }

    public function getTokenType() {
        return $this->token_type;
    }

    public function setTokenType($token_type) {
        $this->token_type = htmlspecialchars(strip_tags($token_type));
    }

    public function getScope() {
        return $this->scope;
    }

    public function setScope($scope) {
        $this->scope = htmlspecialchars(strip_tags($scope));
    }

    public function getIdToken() {
        return $this->id_token;
    }

    public function setIdToken($id_token) {
        $this->id_token = htmlspecialchars(strip_tags($id_token));
    }

    public function getSessionState() {
        return $this->session_state;
    }

    public function setSessionState($session_state) {
        $this->session_state = htmlspecialchars(strip_tags($session_state));
    }

    // CRUD methods
    public function create() {
        // Query to insert a record
        $query = "INSERT INTO " . $this->table_name . " SET userId=:userId, type=:type, provider=:provider, providerAccountId=:providerAccountId, refresh_token=:refresh_token, access_token=:access_token, expires_at=:expires_at, token_type=:token_type, scope=:scope, id_token=:id_token, session_state=:session_state";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":provider", $this->provider);
        $stmt->bindParam(":providerAccountId", $this->providerAccountId);
        $stmt->bindParam(":refresh_token", $this->refresh_token);
        $stmt->bindParam(":access_token", $this->access_token);
        $stmt->bindParam(":expires_at", $this->expires_at);
        $stmt->bindParam(":token_type", $this->token_type);
        $stmt->bindParam(":scope", $this->scope);
        $stmt->bindParam(":id_token", $this->id_token);
        $stmt->bindParam(":session_state", $this->session_state);

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
        $query = "UPDATE " . $this->table_name . " SET userId=:userId, type=:type, provider=:provider, providerAccountId=:providerAccountId, refresh_token=:refresh_token, access_token=:access_token, expires_at=:expires_at, token_type=:token_type, scope=:scope, id_token=:id_token, session_state=:session_state WHERE id=:id";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":provider", $this->provider);
        $stmt->bindParam(":providerAccountId", $this->providerAccountId);
        $stmt->bindParam(":refresh_token", $this->refresh_token);
        $stmt->bindParam(":access_token", $this->access_token);
        $stmt->bindParam(":expires_at", $this->expires_at);
        $stmt->bindParam(":token_type", $this->token_type);
        $stmt->bindParam(":scope", $this->scope);
        $stmt->bindParam(":id_token", $this->id_token);
        $stmt->bindParam(":session_state", $this->session_state);
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
