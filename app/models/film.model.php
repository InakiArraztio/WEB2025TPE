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

    function getMovie($id) {
        $query = $this->db->prepare('
                SELECT p.*, g.nombre AS genero
                FROM pelicula p
                JOIN genero g ON p.id_genero = g.id_genero
                WHERE p.id_pelicula = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function insertFilm($titulo,$anio,$rating,$id_genero) {
        $query = $this->db->prepare('INSERT INTO pelicula (titulo,anio,rating,id_genero) VALUES (?,?,?,?)');
        $query->execute([$titulo,$anio,$rating,$id_genero]);
        return $this->db->lastInsertId();
    }

    
    //Funcion para que verificar no exista una pelicula por nombre y año
    function getFilmByTitleAndYear($titulo, $year) {
        $query = $this->db->prepare('SELECT * FROM pelicula WHERE titulo = ? AND anio = ?');
        $query->execute([$titulo, $year]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    function updateFilm($id,$titulo,$anio,$rating,$id_genero) {
        $query = $this->db->prepare('
                        UPDATE pelicula SET  
                        titulo = ?, anio = ?, rating = ?, id_genero = ?
                        WHERE id_pelicula = ?');
        $query->execute([$titulo,$anio,$rating,$id_genero,$id]);
    }

    function deleteFilm($id) {
        $query = $this->db->prepare('DELETE FROM pelicula WHERE id_pelicula = ?');
        $query->execute([$id]);
    }

}