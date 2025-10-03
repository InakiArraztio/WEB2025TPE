<?php

require_once 'app/models/film.model.php';
require_once 'app/views/film.view.php';

class FilmsController {
    private $model;
    private $view;

    function __construct() {
        $this->model = new FilmsModel();
        $this->view = new FilmsView();
    }

    function getMovies() {
        $movies = $this->model->getMovies();
        $this->view->showMovies($movies);
    }
}