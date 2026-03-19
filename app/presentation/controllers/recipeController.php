<?php 

session_start();

// required includes:
require_once __DIR__ . '/../../business/managers/apiManager.php';
require_once __DIR__ . '/../../business/managers/databaseManager.php';

// class to store the controller that manages the information shown to the user:
class recipeController {
    // variable to store the manager instance for the API:
    private $apiManager;
    // variable to store the parameters used in the search:
    private $searchParameters;
    // variable to store the api manager instance:
    private $databaseManager;

    // variable to store the text that must appear in the favorites button:
    private $btnText;

    // controller: 
    public function __construct() {
        $this->searchParameters = [];
        $this->apiManager = new apiManager();
        $this->btnText = "Add to Favorites";
        $this->databaseManager = new databaseManager();
    }

    // main function to execute the information deployment:
    public function showRecipe() {
        // check if the user has been previously logged:
        if (!isset($_SESSION['user_email'])) {
            // in case the user is not logged:
            header('Location: login.php');
            exit;
        }

        // get the parameters from the URL:
        if (isset($_GET['id'])) {
            $product_id = $_GET['id'];  // product ID

            // add the ID to the parameters array to pass it to the API:
            $this->searchParameters = $product_id;

            // make the API request to get the specific information:
            $data = $this->apiManager->obtainRecipeInfo($this->searchParameters);

            $returnUrl = $_GET['return'] ?? 'search.php';

            $btnText = $this->btnText;

        } else {
            $product_id = null;
        }


        $user_email = $_SESSION['user_email'];
        $user_id = $this->databaseManager->getUserByEmail($user_email);

        $isFavorite = $this->databaseManager->checkIfExistsUserFavorites($user_id, $product_id);

        $btnText = $isFavorite ? "Remove from Favorites" : "Add to Favorites";


        // include the HTML file that should be displayed:
        include __DIR__ . '/../views/detail.html';   
    }
}

?>
