<?php

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        // create the new connection with the database:
        $this->pdo = new PDO(
            'mysql:host=mysql;port=3306;dbname=project_db',
            'pw2user',
            'pw2pass'
        );
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}

?>