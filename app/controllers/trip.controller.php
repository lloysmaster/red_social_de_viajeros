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
}
