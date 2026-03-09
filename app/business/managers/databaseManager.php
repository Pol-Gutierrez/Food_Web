<?php

class databaseManager {
    // variable to store the connection with the database:
    private $connection;

    // constructor:
    public function __construct() {
        // create the new connection with the database:
        $this->connection = new PDO(
            'mysql:host=mysql;port=3306;dbname=project_db',
            'pw2user',
            'pw2pass'
        );
    }

    // function to add a new entry in the database:
    public function addUser($user_email, $user_password) {
        $statement = $this->connection->prepare(
            'INSERT INTO Users (email, password, created_at, updated_at) VALUES (?, ?, NOW(), NOW())'
        );

        // ensure the query does not generate SQL injection:
        $statement->bindParam(1, $user_email, PDO::PARAM_STR);
        $statement->bindParam(2, $user_password, PDO::PARAM_STR);
        
        // execute the query:
        $statement->execute();
    }

    // function to check if the introduced email already exists:
    public function checkIfExists($email) {
        $statement = $this->connection->prepare(
            'SELECT COUNT(*) AS total FROM Users WHERE email = ?'
        );

        // ensure the query does not generate SQL injection:
        $statement->bindParam(1, $email, PDO::PARAM_STR);

        // execute the query:
        $statement->execute();

        // get the results: 
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        // access the "total" property:
        $count = $results[0]['total'];
        // if exists:
        if ($count >= 1) {
            return 1;
        } else {
            return 0;
        }
    }
}

?>
