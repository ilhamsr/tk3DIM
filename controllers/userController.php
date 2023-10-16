<?php
require_once 'models/usersModel.php';

class UserController {
    private $usersModel;

    public function __construct() {
        // Create an instance of the UserModel
        $database = new Database();
        $db = $database->getConnection();
        $this->usersModel = new UsersModel($db);
    }

    // List all users
    public function listUsers() {
        return $this->usersModel->read();
    }

    // Create a new user
    public function createUser($data) {
        // You should validate and sanitize input data here
        return $this->usersModel->create($data);
    }

    // Update a user
    public function updateUser($id, $data) {
        // You should validate and sanitize input data here
        return $this->usersModel->updateUser($id, $data);
    }

    // Delete a user
    public function deleteUser($id) {
        return $this->usersModel->deleteUser($id);
    }

    // Get a user by ID
    public function getUser($id) {
        return $this->usersModel->getUser($id);
    }

    public function login($email, $password) {
        $user = $this->usersModel->getUserByEmail($email);

        if ($password == $user['password']) {
            // Successful login
            session_start();
            $_SESSION['user_id'] = $user['id_user'];
            return true;
        }

        return false; // Login failed
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function logout() {
        session_start();
        session_destroy();
    }
}
?>