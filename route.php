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
    case 'editFilm';
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
    case 'genres':
        //B1: Listado de categorias: (generos)
        $controller = new GenderController();
        $controller->showGender();
        break;
    case 'filmGender':
        //B2: Listado de items por categoria: (peliculas filtradas por genero)
        $controller = new GenderController();
        $controller->filmsByGender($params[1]);
        break;
    case 'addGendre':

        break;
    case 'insertGenre':

        break;
    case 'updateGenre':

        break;
    case 'deleteGenre':
    
        break;

    default:
        echo 'Accion no definida';
}