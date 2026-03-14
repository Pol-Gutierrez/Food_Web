<?php 

session_start();

// required includes:
require_once __DIR__ . '/../../business/managers/apiManager.php';

// class to store the controller that manages user authorization to access the website:
class searchController {
    // variable to store the manager instance for the API:
    private $apiManager;
    // variable to store the parameters used in the search:
    private $searchParameters;

    // controller: 
    public function __construct() {
        $this->searchParameters = [];
        $this->apiManager = new apiManager();
    }

    // main function to execute the search:
    public function search() {
        // check if the user has been previously logged:
        if (!isset($_SESSION['user_email'])) {
            // in case the user is not logged:
            header('Location: login.php');
            exit;
        }

        // once the form fields are filled and submitted:
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // get the parameters entered by the user:
            $fullSentence = trim($_POST['searchbar'] ?? " ");
            $this->searchParameters = explode(" ", $fullSentence);

            // I call the function to make a request to the API:
            $data = $this->apiManager->makePetition($this->searchParameters);
        }

        // include the HTML file that should be displayed:
        include __DIR__ . '/../views/search.html';       
    }
}

?>
