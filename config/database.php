<?php
    class Database {
        private $host = "localhost";
        private $db_name = "practice_auth";
        private $username = "root";
        private $password = "";

        public $conn;

        public function getConnection() {
            $this->conn = null;
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            try {

            }catch(PDOException $e) {
                echo "Connection Error: " . $e->getMessage();
            }
            return $this->conn;
        }
    }
?>