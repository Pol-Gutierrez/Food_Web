<?php 

// required includes:
require_once __DIR__ . '/databaseManager.php';

class userManager {
    // variable to store the instance of the class that interacts with the database:
    private $dbConnector;

    public function __construct() {
        // create a new instance of the class that connects to the database:
        $this->dbConnector = new databaseManager();
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
            echo "The email is incorrect";
        }

        // validate if the password has the correct format:
        if (!$this->isValidPassword($password)) {
            // indicate that an error occurred:
            echo "The password is incorrect";
        }

        // check if the email already exists:
        // (pending implementation)

        // call the database manager to insert the user:
        $this->dbConnector->addUser($email, $password);

        // return the result informing what happened:
        // (pending implementation)
    }

}

?>
