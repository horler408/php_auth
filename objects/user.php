<?php 
    class User {
        private $conn;
        private $table_name = "users";
    
        // Object properties
        public $id;
        public $first_name;
        public $last_name;
        public $email;
        public $contact_number;
        public $address;
        public $password;
        public $access_level;
        public $access_code;
        public $status;
        public $created;
        public $modified;
    
        // constructor
        public function __construct($db){
            $this->conn = $db;
        }

        function emailExists() {
            $query = "SELECT id, first_name, last_name, access_level, password, status
                    FROM " . $this->table_name . " WHERE email = ? LIMIT 0,1";

            $stmt = $this->conn->prepare($query);

            // To sanitise email input
            $this->email = htmlspecialchars(strip_tags($this->email));

            $stmt->bindParam(1, $this->email);
            $stmt->execute();

            // To get number of rows
            $num = $stmt->rowCount();

            if($num > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // To assign value to object properties
                $this->id = $row['id'];
                $this->first_name = $row['first_name'];
                $this->last_name = $row['last_name'];
                $this->access_level = $row['access_level'];
                $this->password = $row['password'];
                $this->status = $row['status'];

                return true;
            }
                return false;
        }

        function create() {
            // To get the time stamp
            $this->created = date('Y-m-d H:i:s');

            $query = "INSERT INTO " . $this->table_name . "
                    SET 
                        first_name = :first_name,
                        last_name = :last_name,
                        email = :email,
                        contact_number = :contact_number,
                        address = :address,
                        password = :password,
                        access_level = :access_level,
                        status = :status,
                        created = :created";

            $stmt = $this->conn->prepare($query);

            // To sanitise inputs
            $this->first_name=htmlspecialchars(strip_tags($this->first_name));
            $this->last_name=htmlspecialchars(strip_tags($this->last_name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->contact_number=htmlspecialchars(strip_tags($this->contact_number));
            $this->address=htmlspecialchars(strip_tags($this->address));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->access_level=htmlspecialchars(strip_tags($this->access_level));
            $this->status=htmlspecialchars(strip_tags($this->status));

            // To hash the password before saving to database
            $password_hash = password_hash($this->password, PASSWORD_BCRYPT);

            // To bind the values
            $stmt->bindParam(':first_name', $this->first_name);
            $stmt->bindParam(':last_name', $this->last_name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':contact_number', $this->contact_number);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':password', $password_hash);
            $stmt->bindParam(':access_level', $this->access_level);
            $stmt->bindParam(':status', $this->status);
            $stmt->bindParam(':created', $this->created);

            if($stmt->execute()) {
                return true;
            }else {
                $this->showError($stmt);
                return false;
            }
        }

        function readAll($from_record_num, $per_page) {
            $query = "SELECT id, first_name, last_name, email, contact_number, access_level, created
                    FROM " . $this->table_name . " ORDER BY id DESC LIMIT ?, ?";

            $stmt = $this->conn->prepare($query);

            // To bind variable values
            $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
            $stmt->bindParam(2, $per_page, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt;
        }

        function countAll() {
            $query = "SELECT id FROM " . $this->table_name . "";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $num = $stmt->rowCount();

            return $num;
        }

        public function showError($stmt){
            echo "<pre>";
                print_r($stmt->errorInfo());
            echo "</pre>";
        }
    }
?>