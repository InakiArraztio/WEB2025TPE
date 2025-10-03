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
    case 'home':
        $controller = new FilmsController();
        $controller->getMovies();
        break;
    case 'genres':
        $controller = new GenderController();
        $controller->showGender();
        break;
    case 'films':

        break;
    case 'information':

        break;
    case 'insert':

        break;
    case 'delete':

        break;
    default:
        echo 'Accion no definida';
}