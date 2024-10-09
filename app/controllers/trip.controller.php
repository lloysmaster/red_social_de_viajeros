<?php
require_once './app/models/trip.model.php';
require_once './app/views/trip.view.php';

class TripController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new TripModel();
        $this->view = new TripView();
    }

    public function showTrips() {
        $trips = $this->model->getTrips();
        return $this->view->showTrips($trips);
    }

    public function showTrip($id) {
        $trip = $this->model->getTrip($id);
        return $this->view->showTrip($trip[0]);
    }

    public function showError() {
        return $this->view->showError();
    }
}
