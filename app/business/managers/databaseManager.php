<?php

require_once __DIR__ . '/../entities/database.php';

class databaseManager {
    // variable to store the connection with the database:
    private $connection;

    // constructor:
    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
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

    // function to check the user login credentials:
    public function checkCredentials($email, $password) {
        $statement = $this->connection->prepare(
            'SELECT COUNT(*) AS total FROM Users WHERE email = ? AND password = ?'
        );

        // ensure the query does not generate SQL injection:
        $statement->bindParam(1, $email, PDO::PARAM_STR);
        $statement->bindParam(2, $password, PDO::PARAM_STR);
        
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

    // function to add a new entry in the UserFavorites table:
    public function addUserFavorites($user_id, $recipe_id) {
        $statement = $this->connection->prepare(
            'INSERT INTO UserFavorites (user_id, recipe_id, created_at) VALUES (?, ?, NOW())'
        );

        // ensure the query does not generate SQL injection:
        $statement->bindParam(1, $user_id, PDO::PARAM_INT);
        $statement->bindParam(2, $recipe_id, PDO::PARAM_INT);
        
        // execute the query:
        $statement->execute();
    }

    // function to remove an entry from the UserFavorites table:
    public function removeUserFavorites($user_id, $recipe_id) {
        $statement = $this->connection->prepare(
            'DELETE FROM UserFavorites WHERE user_id = ? AND recipe_id = ?'
        );

        // ensure the query does not generate SQL injection:
        $statement->bindParam(1, $user_id, PDO::PARAM_INT);
        $statement->bindParam(2, $recipe_id, PDO::PARAM_INT);
        
        // execute the query:
        $statement->execute();
    }

    // function to obtain the user_id knowing the email:
    public function getUserByEmail($user_email) {
        $statement = $this->connection->prepare(
            'SELECT user_id FROM Users WHERE email = ?'
        );

        // ensure the query does not generate SQL injection:
        $statement->bindParam(1, $user_email, PDO::PARAM_STR);

        // execute the query:
        $statement->execute();

        // get the results:
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result[0]['user_id'];
    }

    // function to check if the user–recipe favorite relation already exists:
    public function checkIfExistsUserFavorites($user_id, $recipe_id) {
        $statement = $this->connection->prepare(
            'SELECT COUNT(*) AS total FROM UserFavorites WHERE user_id = ? AND recipe_id = ?'
        );

        // ensure the query does not generate SQL injection:
        $statement->bindParam(1, $user_id, PDO::PARAM_INT);
        $statement->bindParam(2, $recipe_id, PDO::PARAM_STR);

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

    // function to add a new recipe into the database:
    public function addRecipe($recipe_id, $recipe_img, $recipe_title) {
        $statement = $this->connection->prepare(
            'INSERT INTO Recipes (recipe_id, title, image, created_at) VALUES (?, ?, ?, NOW())'
        );

        // ensure the query does not generate SQL injection:
        $statement->bindParam(1, $recipe_id, PDO::PARAM_INT);
        $statement->bindParam(2, $recipe_title, PDO::PARAM_STR);
        $statement->bindParam(3, $recipe_img, PDO::PARAM_STR);
        
        // execute the query:
        $statement->execute();
    }

    // function to check if a recipe instance already exists in the database:
    public function checkIfExistsRecipe($recipe_id) {
        $statement = $this->connection->prepare(
            'SELECT COUNT(*) AS total FROM Recipes WHERE recipe_id = ?'
        );

        // ensure the query does not generate SQL injection:
        $statement->bindParam(1, $recipe_id, PDO::PARAM_INT);

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

    // function to get the favorites list related to the user:
    public function askForFavorites($user_id) {
        $statement = $this->connection->prepare(
            'SELECT r.recipe_id, r.title, r.image FROM Recipes AS r JOIN UserFavorites AS uf ON uf.recipe_id = r.recipe_id 
            WHERE uf.user_id = ?'
        );

        // ensure the query does not generate SQL injection:
        $statement->bindParam(1, $user_id, PDO::PARAM_INT);
        
        // execute the query:
        $statement->execute();

        // get the results:
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}

?>