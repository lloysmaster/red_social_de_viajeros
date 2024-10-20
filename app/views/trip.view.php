<?php

class TripView {
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
    }

    public function showTrips($trips, $res) {
        require 'templates/trips-list.phtml';
    }

    public function showTrip($trip, $res) {
        require 'templates/trip-detail.phtml';
    }

    public function showAddTrip($users, $res) {
        $trip = null;
        require 'templates/new-trip-form.phtml';
    }

    public function showEditTrip($users, $id, $trip) {
        require 'templates/edit-trip-form.phtml';
    }

    public function showError() {
        require 'templates/error.phtml';
    }
}
