<?php
    require_once 'config.php';
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
            handleTripValidations($params[1], $res);
            break;
        case 'mostrarAgregar':
            sessionAuthMiddleware($res);
            handleUserValidationsForShowingAdd($res);
            break;
        case 'agregar':
            sessionAuthMiddleware($res);
            handleUserValidationsForAdd($res);
            break;
        case 'mostrarEditar':
            sessionAuthMiddleware($res);
            handleShowEditValidations($params[1], $res);
            break;
        case 'editar':
            sessionAuthMiddleware($res);
            handleEditValidations($params[1], $res);
            break;
        case 'borrarViaje':
            sessionAuthMiddleware($res);
            handleDeleteValidations($params[1], $res);
            break;
        case 'mostrarLogin':
            sessionAuthMiddleware($res);
            handleLoginValidations($res);
            break;
        case 'login':
            $authController = new AuthController();
            $authController->login();
            break;
        case 'mostrarRegistro':
            sessionAuthMiddleware($res);
            handleSignInValidations($res);
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

    function handleTripValidations($tripId, $user) {
        if(!empty($tripId)) {
            $tripController = new TripController($user);
            if (is_numeric($tripId)) {
                $tripController->showTrip($tripId, $user);
            } else {
                $tripController->showError();
            }
        } else {
            header('Location: ' . BASE_URL);
        }
    }

    function handleUserValidationsForShowingAdd($res) {
        if($res->user) {
            $tripController = new TripController($res);
            $tripController->showAddTrip($res);
        } else {
            header('Location: ' . BASE_URL);
        }
    }

    function handleUserValidationsForAdd($res) {
        if($res->user) {
            $tripController = new TripController($res);
            $tripController->addTrip($res);
        } else {
            header('Location: ' . BASE_URL . 'mostrarLogin');
        }
    }

    function handleShowEditValidations($tripId, $res) {
        if(!empty($tripId) && $res->user) {
            $tripController = new TripController($res);
            if (is_numeric($tripId)) {
                $tripController->showEditTrip($tripId);
            } else {
                $tripController->showError();
            }
        } else {
            header('Location: ' . BASE_URL);
        }
    }

    function handleEditValidations($tripId, $res) {
        if(!empty($tripId) && $res->user) {
            $tripController = new TripController($res);
            $tripController->editTrip($tripId);
        } else {
            if (!$res->user) {
                header('Location: ' . BASE_URL . 'mostrarLogin');
            } else {
                header('Location: ' . BASE_URL);
            }
        }
    }

    function handleDeleteValidations($tripId, $res) {
        if(!empty($tripId) && $res->user) {
            $tripController = new TripController($res);
            if (is_numeric($tripId)) {
                $tripController->deleteTrip($tripId);
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
    }

    function handleLoginValidations($res) {
        if(!$res->user) {
            $authController = new AuthController();
            $authController->showLogin();
        } else {
            header('Location: ' . BASE_URL);
        }
    }

    function handleSignInValidations($res) {
        if(!$res->user) {
            $authController = new AuthController();
            $authController->showRegister();
        } else {
            header('Location: ' . BASE_URL);
        }
    }
?>