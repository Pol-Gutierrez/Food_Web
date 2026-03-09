<?php

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

try {
    $response = $client->request('GET', 'https://jsonplaceholder.typicode.com/posts/1');
    $data = json_decode($response->getBody(), true);

    echo "<h2>Post Title: " . $data['title'] . "</h2>";
    echo "<p>Post Body: " . $data['body'] . "</p>";
} catch (Exception $e) {
    echo "<h2>An error occurred:</h2> " . $e->getMessage();
}











<?php 

// clase para almacenar el controller que gestionar las autorizaciones del usuario para entrar a la web:
class authController {
    // manager para la gestion de los usuarios:
    private $manager;

    // constructor de la clase:
    public function __construct() {
        $this->manager = new 
    }

    // funcion para ejecutar el controller:
    public function runAuth() {
        
        // una vez se rellenen los campos del formulario y se suban:
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // leo los datos que me han entrado
            $user_name = $_POST['name'];
            $user_surname = $_POST['surname'];
            $user_email = $_POST['email'];
            $user_password = $_POST['password'];
        }

        // incluyo el fichero html que quiero que se muestre por pantalla:
        include __DIR__ . '/../views/register.html';
    }
}



?>