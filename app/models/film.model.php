<?php

class FilmsModel {
    private $db;

    function __construct() {
        $this->db = $this->getConnection();
    }

    private function getConnection() {
        return new PDO('mysql:host=localhost;dbname=db_blockbuster;charset=utf8', 'root', ''); 
    }

    function getMovies() {
        $query = $this->db->prepare('SELECT * FROM pelicula');
        $query->execute();
        $movies = $query->fetchAll(PDO::FETCH_OBJ);
        return $movies;
    }

    function getProduct($id) {
        $query = $this->db->prepare('SELECT * FROM pelicula WHERE id_pelicula = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}