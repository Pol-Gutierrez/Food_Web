<?php

class apiManager {
    // variable that contains the final url to wich i'm going to do the petition:
    private $final_url;

    // constructor:
    public function __construct() {
        // create the new connection with the database:
        $this->final_url = $this->final_url = "https://api.spoonacular.com/recipes/complexSearch?query=";
    }

    // function to make an API petition:
    public function makePetition($urlParameters) {
        // function to crete the url based on the parameters: 
        $this->urlFormation($urlParameters);

        //echo $this->final_url;
        //echo "<br>";

        $response = file_get_contents($this->final_url);

        $data = json_decode($response, true);

        return $data;
    }

    // function to create the url:
    private function urlFormation($urlParameters) {
        $this->final_url .= $urlParameters[0];

        $i = 0;
        foreach ($urlParameters as $value) {
            if ($i === 0) {
                $i++;
                continue; // jumps the first element.
            }

            $this->final_url .= "&";
            $this->final_url .= $value;

            $i++;
        }

        // add the API key to access:
        $this->final_url .= "&apiKey=4621be74acdd4d08a52d6bf433a53cd8";
    }
   
}

?>
