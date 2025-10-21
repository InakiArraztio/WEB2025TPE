<?php

require_once 'app/controllers/film.controller.php';
require_once 'app/controllers/gender.controller.php';
require_once 'app/controllers/auth.controller.php';
require_once 'app/middlewares/session.middleware.php';
require_once 'app/middlewares/auth.middleware.php';

session_start();

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// leo la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}

$params = explode('/', $action);

// Inicio el request con la sesion
$request = new StdClass();
$request = (new SessionMiddleware())->run($request);


switch($params[0]) {
    // ---- Peliculas (n) ----
    case 'home':
        //A1: listado items: (peliculas)
        $controller = new FilmsController();
        $controller->getMovies($request);
        break;

    case 'movie':
        //A2: Detalle de item (pelicula individual)
        $controller = new FilmsController();
        $controller->getMovie($params[1], $request);
        break;

        //A: Listar items (peliculas)
    case 'addFilm':
        $request = (new AuthMiddleware())->run($request);
        $controller = new FilmsController();
        $controller->addFilm($request);
        break;

        //A: Agregar items (peliculas)
    case 'insertFilm': 
        $request = (new AuthMiddleware())->run($request);
        $controller = new FilmsController();
        $controller->insertFilm($request);
        break;

        //A: Editar items (peliculas), proceso el formualrio y actualizo la DB
    case 'updateFilm':  
        $request = (new AuthMiddleware())->run($request);
        $controller = new FilmsController();
        $controller->updateFilm($params[1], $request);
        break;

    case 'editFilm'; 
        $request = (new AuthMiddleware())->run($request);
        //Muestro el formulario con los datos actuales
        $controller = new FilmsController();
        $controller->editFilm($params[1], $request);
        break;

        //A: Eliminar Itemas (peliculas)
    case 'deleteFilm':
        $request = (new AuthMiddleware())->run($request);
        $controller = new FilmsController();
        $controller->deleteFilm($params[1], $request);
        break;

    // ---- Generos (1) ----
    case 'genders':
        // Listado de géneros
        $controller = new GenderController();
        $controller->showGender($request);
        break;

    case 'filmGender':
        // Películas filtradas por género
        $controller = new GenderController();
        $controller->filmsByGender($params[1], $request);
        break;

    case 'addGender':
        $request = (new AuthMiddleware())->run($request);
        $controller = new GenderController();
        $controller->addGender($request);
        break;

    case 'insertGender':
        $request = (new AuthMiddleware())->run($request);
        $controller = new GenderController();
        $controller->insertGender($request);
        break;

    case 'updateGender':
        $controller = new GenderController();
        $controller->updateGender($params[1], $request);
        break;

    case 'editGender':
        $request = (new AuthMiddleware())->run($request);
        $controller = new GenderController();
        $controller->editGender($params[1], $request);
        break;

    case 'deleteGender':
        $request = (new AuthMiddleware())->run($request);
        $controller = new GenderController();
        $controller->deleteGender($params[1], $request);
        break;

    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin($request);
        break;

    case 'login':
        $controller = new AuthController();
        $controller->login($request);
        break;

    case 'logout':
        $request = (new AuthMiddleware())->run($request);
        $controller = new AuthController();
        $controller->logout($request);
        break;

    default:
        echo 'Accion no definida';
        break;
}
