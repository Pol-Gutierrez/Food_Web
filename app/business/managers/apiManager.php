<?php

require __DIR__ . '/../../../vendor/autoload.php';

use GuzzleHttp\Client;

class apiManager {
    // variable that contains the final URL to which I'm going to make the request:
    private $final_url;
    // client for guzzle:
    private $client;
    // variables that contains the URL to which I'm going to make the recipe information request:
    private $baseSearchURL = 'https://api.spoonacular.com/recipes/complexSearch?query=';
    private $baseDetailURL = 'https://api.spoonacular.com/recipes/';
    private $apiKey = '4621be74acdd4d08a52d6bf433a53cd8';

    // constructor:
    public function __construct() {
        $this->final_url = "";
        $this->client = new Client();
    }

    // function to make an API request:
    public function makePetition($urlParameters) {
        try {
            $this->urlFormation($urlParameters);

            $query = [
                'query' => $this->final_url,
                'number' => 9,
                'apiKey' => $this->apiKey
            ];

            $response = $this->client->request('GET', $this->baseSearchURL, [
                'query' => $query
            ]);

            $data = json_decode($response->getBody(), true);
            
            return $data;
        } catch (Exception $e) {
            $data['error'] = "An error occurred.";
            return $data;
        }
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
    }

    // function to request specific information about a recipe:
    public function obtainRecipeInfo($searchParameters) {
        try {
            $query = [
                'apiKey' => $this->apiKey
            ];

            $response = $this->client->request('GET', $this->baseDetailURL . $searchParameters . "/information", [
                'query' => $query
            ]);

            $data = json_decode($response->getBody(), true);
            
            return $data;
        } catch (Exception $e) {
            $data['error'] = "An error occurred.";
            return $data;
        }
    }   
}

?>
