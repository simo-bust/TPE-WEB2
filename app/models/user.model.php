<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=libreria_tudai;charset=utf8', 'root', '');
    }

    public function getUser($name){
        $query = $this->db->prepare('SELECT * FROM usuario WHERE nombre = ?');
        $query->execute([$name]);

        $user = $query->fetch(PDO::FETCH_OBJ);

        return $user;
    }


}