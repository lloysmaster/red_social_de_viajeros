<?php
require_once "db.model.php";
class TripModel extends dbModel {
 
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

    public function addTrip($trip) {
        $query = $this->db->prepare('INSERT INTO viajes 
                            (pais, ciudad, pais_destino, ciudad_destino, fecha_ini, fecha_fin, user_id) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)');
        $query->execute([$trip->departureCountry, $trip->departureCity, $trip->arrivalCountry, $trip->arrivalCity, $trip->startDate, $trip->endDate, $trip->passenger]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }

    public function editTrip($trip) {
        $query = $this->db->prepare('UPDATE viajes 
                                    SET 
                                        pais = ?, 
                                        ciudad = ?, 
                                        pais_destino = ?, 
                                        ciudad_destino = ?, 
                                        fecha_ini = ?, 
                                        fecha_fin = ?, 
                                        user_id = ?
                                    WHERE 
                                        id = ?');
        $query->execute([$trip->departureCountry, $trip->departureCity, $trip->arrivalCountry, $trip->arrivalCity, $trip->startDate, $trip->endDate, $trip->passenger, $trip->id]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }

    public function deleteTrip($id) {
        $query = $this->db->prepare('DELETE FROM viajes WHERE viajes.id=?');
        $query->execute([$id]);
    }
}