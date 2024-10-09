<?php
require_once './app/controllers/trip.controller.php';
    define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

    $action = 'viajes';
    if (!empty( $_GET['action'])) {
        $action = $_GET['action'];
    }

    $params = explode('/', $action);

    switch ($params[0]) {
        case 'viajes':
            $controller = new TripController();
            $controller->showTrips();
            break;
        default: 
            echo "404 Page Not Found";
            break;
    }
    
?>