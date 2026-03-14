<?php 

session_start();

// required includes:
require_once __DIR__ . '/../../business/managers/apiManager.php';

// class to store the controller that manages the information is shown to the user:
class recipeController {
    // variable to store the manager instance for the API:
    private $apiManager;
    // variable to store the parameters used in the search:
    private $searchParameters;

    // controller: 
    public function __construct() {
        $this->searchParameters = [];
        $this->apiManager = new apiManager();
    }

    // main function to execute the information deployment:
    public function showRecipe() {
        // obtengo los parametros de la url: 
        if (isset($_GET['id'])) {
            $product_id = $_GET['id'];  // id del producto

            // añado el id al array de parametros para pasarlo a la base: 
            $this->searchParameters = $product_id;

            // hago la peticion a la api para que me de la informacion especifica:
            $data = $this->apiManager->obtainRecipeInfo($this->searchParameters);

            //echo $data;
            /*echo $data['title'];
            echo "<br>";
            echo "<img src='" . $data['image'] . "'>";
            echo "<pre>";
            print_r($data['extendedIngredients']);
            echo "</pre>";
            echo $data['instructions'];

            var_dump($data['image']);*/
        } else {
            $product_id = null;
        }
        // include the HTML file that should be displayed:
        include __DIR__ . '/../views/detail.html';   
    }
}

?>
