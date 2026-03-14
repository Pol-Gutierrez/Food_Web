<?php 

// required includes:
//require_once __DIR__ . '/init_project.php';
require_once __DIR__ . '/../app/presentation/controllers/recipeController.php';

// create the controller that manages authorizations:
$controller = new recipeController();

// execute the controller function:
$controller->showRecipe();


?>