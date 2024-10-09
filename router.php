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
        case 'viaje':
            if (!empty($params[1])) {
                $controller = new TripController();
                if (is_numeric($params[1])) {
                    $controller->showTrip($params[1]);
                } else {
                    $controller->showError();
                }
            } else {
                header('Location: ' . BASE_URL);
            }
            break;
        default: 
            $controller = new TripController();
            $controller->showError();
            break;
    }
?>