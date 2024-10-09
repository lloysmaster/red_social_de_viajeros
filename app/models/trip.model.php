<?php

class TripModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=red_social_de_viajeros;charset=utf8', 'root', '');
    }
 
    public function getTrips() {
        $query = $this->db->prepare('SELECT * FROM viajes');
        $query->execute();
    
        $trips = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $trips;
    }
}