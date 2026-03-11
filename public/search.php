<?php 
    
    // required includes:
    require_once __DIR__ . '/init_project.php';
    require_once __DIR__ . '/../app/presentation/controllers/searchController.php';

    // start the session for the connected user:
    //session_start();

    // create the controller that manages authorizations:
    $controller = new searchController();

    // execute the controller function:
    $controller->search();
?>
