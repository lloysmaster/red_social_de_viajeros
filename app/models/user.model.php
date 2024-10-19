<?php
require_once "db.model.php";
class UserModel extends dbModel {
 
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