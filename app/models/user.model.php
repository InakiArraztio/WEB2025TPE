<?php

class UserModel {
    
    private $db;

    function __construct() {
        $this->db = $this->getConnection();
    }

    private function getConnection() {
        return new PDO('mysql:host=localhost;dbname=db_blockbuster;charset=utf8', 'root', ''); 
    }

    function get($id) {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE id_user = ?');
        $query->execute([$id]);
        $user = $query->fetch(PDO::FETCH_OBJ);

        return $user;
    }


    function getByUser ($user) {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE user = ?');
        $query->execute([$user]);
        $user = $query->fetch(PDO::FETCH_OBJ);

        return $user;
    }

    function getAllUser($username) {
        $query = $this->db->prepare('SELECT * FROM usuario');
        $query->execute([$username]);
        $user = $query->fetchAll(PDO::FETCH_OBJ);
        return $user;
    }

    function insert($name, $password) {
        $query = $this->db->prepare('INSERT INTO usuario(user, password) VALUES (?,?)');
        $query->execute([$name,$password]);
        return $this->db->lastInsertId();
    }
}