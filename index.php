<?php
// Bootstrap the application, include necessary files and set up configurations

// Example: Include the necessary files (autoloader, models, and controllers).
require 'database.php'; // Include the database connection file
require 'models/usersModel.php'; // Include the UserModel
require 'models/roleModel.php'; // Include the RoleModel
require 'controllers/roleController.php'; // Include the UserController
require 'controllers/userController.php'; // Include the RoleController

// Create instances of controllers
$userController = new UserController();
$roleController = new RoleController();

// Determine the route and action based on the URL or other request parameters
$route = $_GET['route'] ?? 'dashboard'; // A default route (e.g., list_users)

// Route the request to the appropriate controller method
switch ($route) {
    case 'dashboard':
        //check session variable
        session_start();
        if (isset($_SESSION['user_id'])) {
            $user = $userController->getUser($_SESSION['user_id']);
            $role = $roleController->getRole($user['id_role']);
            $_SESSION['role'] = $role;
            header('Location: dashboard/dashboard.php');
        } else {
            $user = null;
            $role = null;
            include 'views/loginView.php';
        }
        break;
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            if ($userController->login($email, $password)) {
                // Successful login, redirect to the user's dashboard or another page
                header('Location: index.php?route=dashboard');

            } else {
                // Login failed, display an error message or redirect back to the login page
                header('Location: index.php?route=login&error=1');
            }
        } else {
            // Display the login form
            include 'views/loginView.php';
        }
        break;
    case 'list_users':
        $users = $userController->listUsers();
        include 'views/userView.php'; // Load the user listing view
        break;
    case 'create_user':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle the form submission to create a new user
            $data = $_POST; // Data from the form
            if ($userController->createUser($data)) {
                // Redirect to the user listing page or show a success message
                header('Location: index.php?route=list_users');
            } else {
                // Handle the error (e.g., show an error message or redirect back to the form)
            }
        } else {
            include 'views/userCreate.php'; // Load the user creation form view
        }
        break;
    case 'delete_user':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle user deletion here based on the ID sent via POST
            $id_user_to_delete = $_POST['id_user'];
            
            $userController->deleteUser($id_user_to_delete);
    
            // Redirect back to the user listing page or display a success message
            header('Location: index.php?route=list_users');
        } else {
            // Handle GET request to the "delete_user" route, if needed
            // Display a confirmation message or page
        }
        break;
        
    case 'edit_user':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle the form submission to update an existing user
            $id_user_to_update = $_POST['id_user'];
            $data = $_POST; // Data from the form
            
            if ($userController->updateUser($id_user_to_update, $data)) {
                // Redirect to the user listing page or show a success message
                header('Location: index.php?route=list_users');
            } else {
                // Handle the error (e.g., show an error message or redirect back to the form)
            }
        } else {
            // Handle GET request to the "edit_user" route, if needed
            // Display the user edit form view
            $id_user_to_edit = $_GET['id'];
            $userData = $userController->getUser($id_user_to_edit);
            include 'views/userEdit.php'; // Load the user edit form view
        }
        break;
    case 'logout':
        $userController->logout(); // Call the logout method from your UserController
        header('Location: index.php?route=login'); // Redirect to the login page
        break;
    default:
        // Handle 404 Not Found
        echo "404 - Not Found";
}
?>