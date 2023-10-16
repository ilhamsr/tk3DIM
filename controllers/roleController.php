<?php

require_once 'models/roleModel.php';

//create rolecontroller class
class RoleController {
    private $roleModel;

    public function __construct() {
        // Create an instance of the UserModel
        $database = new Database();
        $db = $database->getConnection();
        $this->roleModel = new RoleModel($db);
    }

    // List all roles
    public function listRoles() {
        return $this->roleModel->listRoles();
    }

    // Create a new role
    public function createRole($data) {
        // You should validate and sanitize input data here
        return $this->roleModel->createRole($data);
    }

    // Update a role
    public function updateRole($id, $data) {
        // You should validate and sanitize input data here
        return $this->roleModel->updateRole($id, $data);
    }

    // Delete a role
    public function deleteRole($id) {
        return $this->roleModel->deleteRole($id);
    }

    //getRole by id
    public function getRole($id) {
        return $this->roleModel->getRole($id);
    }
}

?>