<?php

require_once 'app/models/film.model.php';
require_once 'app/views/film.view.php';

class FilmsController {
    private $model;
    private $view;
    private $modelGenre;
    private $controllerGender;

    function __construct() {
        $this->model = new FilmsModel();
        $this->view = new FilmsView();
        $this->modelGenre = new GenderModel();
        $this->controllerGender = new GenderController();
    }

    // A1 - Listado de Items
    function getMovies() {
        $movies = $this->model->getMovies();
        $this->view->showMovies($movies);
    }

    // A2 - Dellate de item
    function getMovie($id) {
        $movie = $this->model->getMovie($id);
        $this->view->showMovie($movie);
    }

    // ABM: Mostrar el form para agregar una pelicula
    function addFilm() {

        require_once 'app/models/gender.model.php';
        $modelGenre = new GenderModel();
        $genres = $modelGenre->getGender();

        $movie = $this->model->getMovies();
        $this->view->showAddFilmForm($movie, $genres);
    }

    function insertFilm() {

        //Hago las validaciones del formulario para insertar
        if(empty($_POST['titulo']) || empty($_POST['anio']) || empty($_POST['rating']) || empty($_POST['id_genero'])) {
            
            return $this->view->showError('Faltan completo datos para insertar una pelicula');

        } else {
            
            $titulo = $_POST['titulo'];
            $anio = $_POST['anio'];
            $rating = $_POST['rating'];
            $id_genero = $_POST['id_genero'];

            $existingFilm = $this->model->getMovies();

            if($existingFilm) {
                return $this->view->showError('Ya existe una pelicula con esos datos');
            }

            $this->model->insertFilm($titulo,$anio,$rating,$id_genero);
            header("Location: " . BASE_URL);
        }

    }

    //Sirve para procesar el formulario y actualizar la base de datos
    function updatefilm($id) {

        if(empty($_POST['titulo']) || empty($_POST['anio']) || empty($_POST['rating']) || empty($_POST['id_genero'])) {
            return $this->view->showError('Faltan completo datos para modificar la pelicula');

        } 
        //Toma los datos que el usuario edito
        $titulo = $_POST['titulo'];
        $anio = $_POST['anio'];
        $rating = $_POST['rating'];
        $id_genero = $_POST['id_genero'];

        //Llamo al modelo para actualizar a la DB
        $this->model->updateFilm($id,$titulo,$anio,$rating,$id_genero);
        header("Location: " . BASE_URL);
    }

    //Mostrar el forumlario de edicion 
    function editFilm($id) {
        //Obtengo los datos de la pelicula y los generos
        $movie = $this->model->getMovie($id);

        if(!$movie) {
            return $this->view->showError("No existe la pelicula");
        }

        //traigo la lista de generos para la opcion <select>
        require_once 'app/models/gender.model.php';
        $genreModel = new GenderModel();
        $genres = $genreModel->getGender();

        //llamo a la vista para que muestra el formulario con los datos actuales
        $this->view->updateFilmData($movie,$genres);
    }


    function deleteFilm() {

    }
}