<?php 

// required includes:
//require_once __DIR__ . '/init_project.php';
require_once __DIR__ . '/../app/presentation/controllers/favoriteController.php';

// create the controller that manages authorizations:
$controller = new favoriteController();

// execute the controller function:
$controller->run();

?>