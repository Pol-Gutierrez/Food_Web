<?php 

session_start();

// required includes:
//require_once __DIR__ . '/../../business/managers/apiManager.php';
require_once __DIR__ . '/../../business/managers/databaseManager.php';

// class to store the controller that manages the information shown to the user:
class favoriteController {
    // variable to store the manager instance for the API:
    private $databaseManager;

    // controller: 
    public function __construct() {
        $this->databaseManager = new databaseManager();
    }

    // function to determine wich action needs to be done:
    public function run() {
        // check if the user has previously logged in:
        if (!isset($_SESSION['user_email'])) {
            // in case the user is not logged in:
            header('Location: login.php');
            exit;
        }        

        // recive the action from the visual part: 
        $action = $_POST['action'] ?? null;

        /*echo "ANTES";
        echo $action;
        echo "DESPUES";*/

        switch ($action) {
            case 'add':
                $this->addFavorite();
                break;
            case 'remove':
                $this->removeFavorite();
                break;
            default:
                $this->showFavoritesList();
                /*break;
            default:
                echo "Acción no válida";*/
        }
    }

    // main function to add a new recipe into the favorites list:
    public function addFavorite() {
        // get the email field of the user who has logged in:
        $user_email = $_SESSION['user_email'];
        $user_id = $this->databaseManager->getUserByEmail($user_email);
        // get the recipe ID field of the recipe that is to be saved as favorite:
        $recipe_id = $_POST['recipe_id'];
        // get the image field of the recipe that is to be saved as favorite:
        $recipe_img = $_POST['recipe_img'];
        // get the title field of the recipe that is to be saved as favorite:
        $recipe_title = $_POST['recipe_title'];

        // verify that the recipe instance does not already exist:
        if ($this->databaseManager->checkIfExistsRecipe($recipe_id) == 0) {
            // insert the relation into the database in case it does not already exist:
            $this->databaseManager->addRecipe($recipe_id, $recipe_img, $recipe_title);
        }

        // verify that the favorites instance does not already exist:
        if ($this->databaseManager->checkIfExistsUserFavorites($user_id, $recipe_id) == 0) {
            // insert the relation into the database in case it does not already exist:
            $this->databaseManager->addUserFavorites($user_id, $recipe_id);
        }
        $returnUrl = $_POST['return_url'];
        header("Location: $returnUrl");
        exit;
    }

    // main function to remove a recipe from the favorites list:
    public function removeFavorite() {

    }

    // main function to show the entire list of all the favorites recipes of the user:
    public function showFavoritesList() {
        /*echo'<script type="text/javascript">
        alert("Tarea Guardada");
        </script>';*/

        $returnUrl = $_GET['return_url'] ?? 'search.php';

        // get the email field of the user who has logged in:
        $user_email = $_SESSION['user_email'];
        $user_id = $this->databaseManager->getUserByEmail($user_email);

        $data['results'] = $this->databaseManager->askForFavorites($user_id);

        // include the HTML file that should be displayed:
        include __DIR__ . '/../views/favorites.html';  
    }
}

?>