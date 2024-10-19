<?php
require_once "db.model.php";
class PassengerModel extends dbModel {
 
    public function getUsers() {
        $query = $this->db->prepare('SELECT *
                                    FROM usuarios
                                    ORDER BY nombre,apellido');
        $query->execute();
    
        $users = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $users;
    }
}