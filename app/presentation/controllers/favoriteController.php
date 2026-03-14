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

    // main function to add a new recipe into the favorites list:
    public function addFavorite() {
        // check if the user has previously logged in:
        if (!isset($_SESSION['user_email'])) {
            // in case the user is not logged in:
            header('Location: login.php');
            exit;
        }        

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
}

?>
