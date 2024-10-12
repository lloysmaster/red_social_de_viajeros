<?php
require_once './app/models/trip.model.php';
require_once './app/views/trip.view.php';

class TripController {
    private $model;
    private $view;

    public function __construct($res) {
        $this->model = new TripModel();
        $this->view = new TripView($res->user);
    }

    public function showTrips($res) {
        $trips = $this->model->getTrips();
        return $this->view->showTrips($trips, $res);
    }

    public function showTrip($id, $res) {
        $trip = $this->model->getTrip($id);
        return $this->view->showTrip($trip[0], $res);
    }

    public function deleteTrip($id) {
        try {
            $this->model->deleteTrip($id);
            header('Location: ' . BASE_URL);
        } catch (PDOException $e) {
            header('Location: ' . BASE_URL);
        }
    }

    public function showError() {
        return $this->view->showError();
    }
}
