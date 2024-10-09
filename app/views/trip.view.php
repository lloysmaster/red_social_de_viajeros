<?php

class TripView {
    public function __construct() {
    }

    public function showTrips($trips) {
        require 'templates/trips-list.phtml';
    }
}
