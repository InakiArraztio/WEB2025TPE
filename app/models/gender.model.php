<?php

class GenderModel {
    private $db;

    function __construct() {
        $this->db = $this->getConnection();
    }

    private function getConnection() {
        return new PDO('mysql:host=localhost;dbname=db_blockbuster;charset=utf8', 'root', ''); 
    }

    function getGender() {
        $query = $this->db->prepare('SELECT * FROM genero');
        $query->execute();
        $gender = $query->fetchAll(PDO::FETCH_OBJ);
        return $gender;
    }
}