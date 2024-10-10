<?php

class UserModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=red_social_de_viajeros;charset=utf8', 'root', '');
    }
 
    public function getUserByUsername($username) {    
        $query = $this->db->prepare("SELECT * FROM acceso_usuarios WHERE username = ?");
        $query->execute([$username]);
    
        $user = $query->fetch(PDO::FETCH_OBJ);
    
        return $user;
    }

    public function setUserByUsername($username, $password) {    
        $query = $this->db->prepare("INSERT INTO acceso_usuarios (username, password) VALUES (?, ?) ");
        $query->execute([$username, $password]);
    
        return $query->rowCount() > 0;
    }
}