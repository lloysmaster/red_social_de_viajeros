<?php

class TripView {
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
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
