<?php 
    
    // required includes:
    //require_once __DIR__ . '/init_project.php';
    require_once __DIR__ . '/../app/presentation/controllers/searchController.php';

    // create the controller that manages authorizations:
    $controller = new searchController();

    // execute the controller function:
    $controller->search();
?>
