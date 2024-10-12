<?php
require_once './app/models/trip.model.php';
require_once './app/models/passenger.model.php';
require_once './app/views/trip.view.php';

class TripController {
    private $tripModel;
    private $passengerModel;
    private $view;

    public function __construct($res) {
        $this->tripModel = new TripModel();
        $this->passengerModel = new PassengerModel();
        $this->view = new TripView($res->user);
    }

    public function showTrips($res) {
        $trips = $this->tripModel->getTrips();
        return $this->view->showTrips($trips, $res);
    }

    public function showTrip($id, $res) {
        $trip = $this->tripModel->getTrip($id);
        return $this->view->showTrip($trip[0], $res);
    }

    public function showAddTrip($res) {
        $users = $this->passengerModel->getUsers();
        return $this->view->showAddTrip($users, $res);
    }

    public function addTrip() {
        if (empty($_POST['departure-country']) 
            || empty($_POST['departure-city'])
            || empty($_POST['arrival-country'])
            || empty($_POST['arrival-city'])
            || empty($_POST['start-date'])
            || empty($_POST['end-date'])
            || empty($_POST['passenger'])) {
            return header('Location: ' . BASE_URL);
        }

        $trip = new stdClass();
        $trip->departureCountry = $_POST['departure-country'];
        $trip->departureCity = $_POST['departure-city'];
        $trip->arrivalCountry = $_POST['arrival-country'];
        $trip->arrivalCity = $_POST['arrival-city'];
        $trip->startDate = $_POST['start-date'];
        $trip->endDate = $_POST['end-date'];
        $trip->passenger = $_POST['passenger'];
    
        $id = $this->tripModel->addTrip($trip);
    
        header('Location: ' . BASE_URL);
    }

    public function deleteTrip($id) {
        try {
            $this->tripModel->deleteTrip($id);
            header('Location: ' . BASE_URL);
        } catch (PDOException $e) {
            header('Location: ' . BASE_URL);
        }
    }

    public function showError() {
        return $this->view->showError();
    }
}
