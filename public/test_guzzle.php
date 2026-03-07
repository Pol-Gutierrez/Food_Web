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