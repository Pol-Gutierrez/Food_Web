<?php 

// start session to store the user id when login:
session_start();

// required includes:
require_once __DIR__ . '/../../business/managers/userManager.php';

// class to store the controller that manages user authorization to access the website:
class authController {
    // manager for user management:
    private $manager;

    // class constructor:
    public function __construct() {
        $this->manager = new userManager();
    }

    // function to execute the register functionality:
    public function register() {
        $errors = [];
        // once the form fields are filled and submitted:
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // read the data received:
            $user_email = $_POST['email']  ?? " ";
            $user_password = $_POST['password']  ?? " ";

            // check that they are not empty:
            if (!is_null($user_email) && !is_null($user_password)) {
                $errors = $this->manager->addNewUser($user_email, $user_password);
            }

            if (empty($errors)) {
                header('Location: login.php');
                exit;
            }
        }

        // include the HTML file that should be displayed:
        include __DIR__ . '/../views/register.html';
    }

    // function to execute the login functionality:
    public function login() {
        $user_email = '';
        $errors = [];
        // once the form fields are filled and submitted:
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // read the data received:
            $user_email = $_POST['email'] ?? '';
            $user_password = $_POST['password'] ?? '';

            // check that they are not empty:
            if (!is_null($user_email) && !is_null($user_password)) {
                $errors = $this->manager->validateCredentials($user_email, $user_password);
            }

            if (empty($errors)) {
                // in case no errors it means the user has been loged succesfully:
                $_SESSION['user_email'] = $user_email;
                header('Location: search.php');
                exit;
            }
        }

        // include the HTML file that should be displayed:
        include __DIR__ . '/../views/login.html';
    }
}

?>
