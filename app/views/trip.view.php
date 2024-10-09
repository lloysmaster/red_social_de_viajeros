<?php

class TripView {
    public function __construct() {
    }

    public function showTrips($trips) {
        require 'templates/trips-list.phtml';
    }

    public function showTrip($trip) {
        require 'templates/trip-detail.phtml';
    }

    public function showError() {
        require 'templates/error.phtml';
    }
}
