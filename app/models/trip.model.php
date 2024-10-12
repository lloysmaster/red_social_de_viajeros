<?php

class TripModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=red_social_de_viajeros;charset=utf8', 'root', '');
    }
 
    public function getTrips() {
        $query = $this->db->prepare('SELECT viajes.id AS viaje_id,
                                    usuarios.id AS usuario_id,
                                    viajes.*,
                                    usuarios.*
                                    FROM viajes JOIN usuarios ON usuarios.id=viajes.user_id
                                    ORDER BY nombre,apellido');
        $query->execute();
    
        $trips = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $trips;
    }

    public function getTrip($id) {
        $query = $this->db->prepare('SELECT viajes.id AS viaje_id,
                                    viajes.*,
                                    usuarios.* 
                                    FROM viajes JOIN usuarios ON usuarios.id=viajes.user_id 
                                    WHERE viajes.id=?');
        $query->execute([$id]);

        $trip = $query->fetchAll(PDO::FETCH_OBJ);
        if(!$trip) {
            header('Location:' . BASE_URL . 'error');
        } else {
            return $trip;
        }
    }

    public function deleteTrip($id) {
        $query = $this->db->prepare('DELETE FROM viajes WHERE viajes.id=?');
        $query->execute([$id]);
    }
}