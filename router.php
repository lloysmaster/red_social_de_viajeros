<?php
    require_once './app/controllers/trip.controller.php';
    require_once './app/controllers/auth.controller.php';
    require_once './app/middlewares/auth.middleware.php';
    require_once './app/libs/response.php';

    define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

    $res = new Response();

    $action = 'viajes';
    if (!empty( $_GET['action'])) {
        $action = $_GET['action'];
    }

    $params = explode('/', $action);

    switch ($params[0]) {
        case 'viajes':
            sessionAuthMiddleware($res);
            $tripController = new TripController($res);
            $tripController->showTrips($res);
            break;
        case 'viaje':
            sessionAuthMiddleware($res);
            if(!empty($params[1])) {
                $tripController = new TripController($res);
                if (is_numeric($params[1])) {
                    $tripController->showTrip($params[1], $res);
                } else {
                    $tripController->showError();
                }
            } else {
                header('Location: ' . BASE_URL);
            }
            break;
        case 'borrarViaje':
            sessionAuthMiddleware($res);
            if(!empty($params[1]) && $res->user) {
                $tripController = new TripController($res);
                if (is_numeric($params[1])) {
                    $tripController->deleteTrip($params[1]);
                } else {
                    $tripController->showError();
                }
            } else {
                if (!$res->user) {
                    header('Location: ' . BASE_URL . 'mostrarLogin');
                } else {
                    header('Location: ' . BASE_URL);
                }
            }
            break;
        case 'mostrarLogin':
            sessionAuthMiddleware($res);
            if(!$res->user) {
                $authController = new AuthController();
                $authController->showLogin();
            } else {
                header('Location: ' . BASE_URL);
            }
            break;
        case 'login':
                $authController = new AuthController();
                $authController->login();
            break;
        case 'mostrarRegistro':
            sessionAuthMiddleware($res);
            if(!$res->user) {
                $authController = new AuthController();
                $authController->showRegister();
            } else {
                header('Location: ' . BASE_URL);
            }
            break;
        case 'registro':
                $authController = new AuthController();
                $authController->register();
            break;
        default: 
            $tripController = new TripController($res);
            $tripController->showError();
            break;
    }
?>