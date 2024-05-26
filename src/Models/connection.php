<?php
/* connection.php */
    namespace models;
    use PDO, PDOException;
    class connection{
        private $servername= "localhost";
        private $username= "root";
        private $password= "";
        private $dbname= "forumdb";
        protected $conn;

        public function __construct()
        {
            try{
                $this->conn= new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
?>