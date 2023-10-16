<?php
class RoleModel {
    private $conn;
    private $table_name = "role";

    public $id_role;
    public $nama_role;
    public $keterangan;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Add other methods for role-related operations (e.g., create, read, update, delete).
    //add create, read, update, delete
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nama_role=:nama_role, keterangan=:keterangan";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nama_role = htmlspecialchars(strip_tags($this->nama_role));
        $this->keterangan = htmlspecialchars(strip_tags($this->keterangan));

        // bind values
        $stmt->bindParam(":nama_role", $this->nama_role);
        $stmt->bindParam(":keterangan", $this->keterangan);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    
    public function read() {
        $query = "SELECT * FROM ". $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    //create update function
    public function update() {
        $query = "UPDATE ". $this->table_name. " SET nama_role=:nama_role, keterangan=:keterangan WHERE id_role=:id_role";
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->nama_role = htmlspecialchars(strip_tags($this->nama_role));
        $this->keterangan = htmlspecialchars(strip_tags($this->keterangan));
        $this->id_role = htmlspecialchars(strip_tags($this->id_role));

        // bind values
        $stmt->bindParam(":nama_role", $this->nama_role);
        $stmt->bindParam(":keterangan", $this->keterangan);
        $stmt->bindParam(":id_role", $this->id_role);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    
    public function delete() {
        $query = "DELETE FROM ". $this->table_name. " WHERE id_role=:id_role";
        $stmt = $this->conn->prepare($query);
        // bind value
        $stmt->bindParam(":id_role", $this->id_role);
        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //getrole by id_role
    public function getRole($id_role) {
        $query = "SELECT * FROM ". $this->table_name. " WHERE id_role=:id_role";
        $stmt = $this->conn->prepare($query);
        // bind value
        $stmt->bindParam(":id_role", $id_role);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // set values to object properties
        $this->id_role = $row['id_role'];
        $this->nama_role = $row['nama_role'];
        $this->keterangan = $row['keterangan'];

        return $row;
    }
}
?>