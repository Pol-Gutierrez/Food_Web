<?php

class apiManager {
    // variable that contains the final URL to which I'm going to make the request:
    private $final_url;
    // variable that contains the URL to which I'm going to make the recipe information request:
    private $detail_url;

    // constructor:
    public function __construct() {
        // create the new connection with the database:
        $this->final_url = "https://api.spoonacular.com/recipes/complexSearch?query=";
        $this->detail_url = "https://api.spoonacular.com/recipes/";
    }

    // function to make an API request:
    public function makePetition($urlParameters) {
        // function to create the URL based on the parameters:
        $this->urlFormation($urlParameters);

        //echo $this->final_url;
        //echo "<br>";

        $response = file_get_contents($this->final_url);

        $data = json_decode($response, true);
        //$data = " ";
        return $data;
    }

    // function to create the URL:
    private function urlFormation($urlParameters) {
        $this->final_url .= $urlParameters[0];

        $i = 0;
        foreach ($urlParameters as $value) {
            if ($i === 0) {
                $i++;
                continue; // skips the first element.
            }

            $this->final_url .= "&";
            $this->final_url .= $value;

            $i++;
        }

        // add the API key to access:
        $this->final_url .= "&number=9&apiKey=e4d7bbf131444654abc221203638ba52";
    }

    // function to request specific information about a recipe:
    public function obtainRecipeInfo($searchParameters) {
        // create the URL to which the request will be made:
        $this->detail_url .= $searchParameters;
        $this->detail_url .= "/information?apiKey=e4d7bbf131444654abc221203638ba52";

        //echo $this->detail_url;
        //echo "<br>";

        $response = file_get_contents($this->detail_url);

        $data = json_decode($response, true);
        //$data = " ";

        return $data;
    }
   
}

?>
