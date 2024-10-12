<?php

class PassengerModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=red_social_de_viajeros;charset=utf8', 'root', '');
    }
 
    public function getUsers() {
        $query = $this->db->prepare('SELECT *
                                    FROM usuarios
                                    ORDER BY nombre,apellido');
        $query->execute();
    
        $users = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $users;
    }
}