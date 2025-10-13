<?php

require_once 'app/controllers/film.controller.php';
require_once 'app/controllers/gender.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// leo la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}

$params = explode('/', $action);

switch($params[0]) {
    // ---- Peliculas (n) ----
    case 'home':
        //A1: listado items: (peliculas)
        $controller = new FilmsController();
        $controller->getMovies();
        break;
    case 'movieInfo':
        //A2: Detalle de item (pelicula individual)
        $controller = new FilmsController();
        $controller->getMovie($params[1]);
        break;
        //A: Listar items (peliculas)
    case 'addFilm':
        $controller = new FilmsController();
        $controller->addFilm();
        break;
        //A: Agregar items (peliculas)
    case 'insertFilm':
        $controller = new FilmsController();
        $controller->insertFilm();
        break;
        //A: Editar items (peliculas), proceso el formualrio y actualizo la DB
    case 'updateFilm':
        $controller = new FilmsController();
        $controller->updateFilm($params[1]);
        break;
    case 'editFilm':
        //Muestro el formulario con los datos actuales
        $controller = new FilmsController();
        $controller->editFilm($params[1]);
        break;
        //A: Eliminar Itemas (peliculas)
    case 'deleteFilm':
        $controller = new FilmsController();
        $controller->deleteFilm($params[1]);
        break;
    // ---- Generos (1) ----
    // ---- Generos (1) ---- 
case 'genders':
    // Listado de géneros
    $controller = new GenderController();
    $controller->showGender();
    break;

case 'filmGender':
    // Películas filtradas por género
    $controller = new GenderController();
    $controller->filmsByGender($params[1]);
    break;

case 'addGender':
    $controller = new GenderController();
    $controller->addGender();
    break;

case 'insertGender':
    $controller = new GenderController();
    $controller->insertGender();
    break;

case 'updateGender':
    $controller = new GenderController();
    $controller->updateGender($params[1]);
    break;

case 'editGender':
    $controller = new GenderController();
    $controller->editGender($params[1]);
    break;

case 'deleteGender':
    $controller = new GenderController();
    $controller->deleteGender($params[1]);
    break;

}