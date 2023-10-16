<?php
    class UsersModel {
        private $conn;
        private $table_name = "users";

        public $id_user;
        public $nama_user;
        public $email;
        public $password;
        public $birthdate;
        public $id_role;
        public $alamat;
        

        public function __construct($db) {
            $this->conn = $db;
        }

        // Add other methods for user-related operations (e.g., create, read, update, delete).
        //add create, read, update, delete
        public function create($data) {
            $query = "INSERT INTO $this->table_name (nama_user, email, password, birthdate, id_role, alamat) VALUES (:nama_user, :email, :password, :birthdate, :id_role, :alamat)";
            
            $stmt = $this->conn->prepare($query);
            
            // Bind parameters
            $stmt->bindParam(':nama_user', $data['nama_user']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':password', $data['password']);
            $stmt->bindParam(':birthdate', $data['birthdate']);
            $stmt->bindParam(':id_role', $data['id_role']);
            $stmt->bindParam(':alamat', $data['alamat']);
        
            if ($stmt->execute()) {
                return true; // User created successfully
            } else {
                return false; // Failed to create user
            }
        }

        public function read() {
            $query = "SELECT *, nama_role as role_name FROM ". $this->table_name." join role ON ". $this->table_name.".id_role = role.id_role";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        //create update function
        public function updateUser($id, $data) {
            $query = "UPDATE $this->table_name SET nama_user = :nama_user, email = :email, password = :password, birthdate = :birthdate, id_role = :id_role, alamat = :alamat WHERE id_user = :id_user";
            
            $stmt = $this->conn->prepare($query);
            
            // Bind parameters
            $stmt->bindParam(':id_user', $id);
            $stmt->bindParam(':nama_user', $data['nama_user']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':password', $data['password']);
            $stmt->bindParam(':birthdate', $data['birthdate']);
            $stmt->bindParam(':id_role', $data['id_role']);
            $stmt->bindParam(':alamat', $data['alamat']);
        
            if ($stmt->execute()) {
                return true; // User updated successfully
            } else {
                return false; // Failed to update user
            }
        }

        public function deleteUser($id) {
            $query = "DELETE FROM $this->table_name WHERE id_user = :id_user";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_user', $id);
            
            if ($stmt->execute()) {
                return true; // User deleted successfully
            } else {
                return false; // Failed to delete user
            }
        }

        //Get Users by id
        public function getUser($id) {
            $query = "SELECT * FROM $this->table_name WHERE id_user = :id_user";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_user', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        //get user by email
        public function getUserByEmail($email) {
            $query = "SELECT * FROM $this->table_name WHERE email = :email";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>