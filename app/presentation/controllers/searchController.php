<?php 

//session_start();

// required includes:
require_once __DIR__ . '/../../business/managers/userManager.php';

// class to store the controller that manages user authorization to access the website:
class searchController {

    // funcion principal para ejecutar la busqueda de recetas:
    public function search() {
        // compruebo si el usuario ha iniciado previamente sesion: 
        if (!isset($_SESSION['user_email'])) {
            // in case the user is not logged:
            //echo "The user is not logged.";
            header('Location: login.php');
            exit;
        }  else {
            echo "No problem with the user.";
            echo $_SESSION['user_email'];
        }

        // once the form fields are filled and submitted:
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            
        }

        // include the HTML file that should be displayed:
        include __DIR__ . '/../views/search.html';
        
    }
}

?>
