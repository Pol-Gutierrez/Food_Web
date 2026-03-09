<?php 

// required includes:
require_once __DIR__ . '/databaseManager.php';

class userManager {
    // variable to store the instance of the class that interacts with the database:
    private $dbConnector;
    // array para almacenar los errores que aparezcan:
    private $errors;

    public function __construct() {
        // create a new instance of the class that connects to the database:
        $this->dbConnector = new databaseManager();
        $this->errors = [];
    }

    // function to verify whether a password is valid or not:
    private function isValidPassword($password) {
        return preg_match('/^(?=.*[A-Z])(?=.*\d).{9,}$/', $password);
    }

    // function to save a new user in the database:
    public function addNewUser($email, $password) {
        // validate if the email has the correct format:
        $valid_email = filter_var($email, FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE);

        // if the format is not correct:
        if (is_null($valid_email)) {
            // indicate that an error occurred:
            $this->errors['email'] = "Email does not follow the correct format.";
        }

        // validate if the password has the correct format:
        if (!$this->isValidPassword($password)) {
            // indicate that an error occurred:
            $this->errors['password'] = "Password does not follow the correct format.";
        }

        // check that they are not empty:
        if (empty(($email))) {
            // indicate that an error occurred:
            $this->errors['email'] = "Field can not be empty.";
        }

        if (empty(($password))) {
            // indicate that an error occurred:
            $this->errors['password'] = "Field can not be empty.";
        }

        // check if the email already exists:
        if ($this->dbConnector->checkIfExists($email)) {
            $this->errors['general'] = "Can not introduce this email.";
        } 
        if (empty($this->errors)) {
            // call the database manager to insert the user:
            $this->dbConnector->addUser($email, $password);
        }

        return $this->errors;
    }

}

?>
