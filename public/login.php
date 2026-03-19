<?php 

// required includes:
//require_once __DIR__ . '/init_project.php';
require_once __DIR__ . '/../app/presentation/controllers/authController.php';

// create the controller that manages authorizations:
$controller = new authController();

// execute the controller function:
//$controller->login();
$controller->run();

?>