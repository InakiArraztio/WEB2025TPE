<?php
require_once 'app/models/gender.model.php';
require_once 'app/views/gender.view.php';
require_once 'app/models/film.model.php';

class GenderController {
    private $model;
    private $view;
    private $movieModel;

    function __construct() {
        $this->model = new GenderModel();
        $this->view = new GenderView();
        $this->movieModel = new FilmsModel();
    }

   
    function showGender($request) {
        $genders = $this->model->getGender();
        $this->view->showGender($genders, $request->user);
    }

    
    function filmsByGender($id, $request) {
        if(empty($id)) {
            return $this->view->showError('No se proporciono el ID del genero.');
        }

        $gender = $this->model->getGenderById($id);
        if(!$gender) {
            return $this->view->showError("No existe el genero con id $id");
        }

        $filmsByGender = $this->model->filmsGender($id);
        $this->view->showGenderFilms($filmsByGender, $request->user);
    }

    
    function addGender($request) {

        if (!$request->user) {
            return $this->view->showError('No tenés permisos para agregar géneros.');
        }

        $this->view->showAddGenderForm($request->user);
    }

   
    function insertGender($request) {
        if (!$request->user) {
            return $this->view->showError('No tenés permisos para realizar esta acción.');
        }

        if (empty($_POST['genero'])) {
            $this->view->showError('⚠️ Falta completar el campo "género".');
            return;
        }

        $nombre = $_POST['genero'];

        
        $existing = $this->model->getByName($nombre);
        if ($existing) {
            $this->view->showError('⚠️ Ya existe un género con ese nombre.');
            return;
        }

        $this->model->insertGender($nombre);
        header("Location: " . BASE_URL . "genders");
    }

    
    function editGender($id, $request) {
        $gender = $this->model->getGenderById($id);
        if (!$gender) {
            $this->view->showError('No existe el género seleccionado.');
            return;
        }
        $this->view->showEditGenderForm($gender, $request->user);
    }

   
    function updateGender($id, $request) {
        if (!$request->user) {
            return $this->view->showError('No tenés permisos para modificar.');
        }

        if (empty($_POST['genero'])) {
            $this->view->showError('⚠️ Falta completar el campo.');
            return;
        }
        
        //Control de genero
        $gender = $this->model->getGenderById($id);
        if(!$gender) {
            return $this->view->showError("El genero con el id: $id no existe.");
        }

        $nombre = $_POST['genero'];
        $this->model->updateGender($id, $nombre);
        header("Location: " . BASE_URL . "genders");
    }

    
    function deleteGender($id, $request) {
        if (!$request->user) {
            return $this->view->showError('No tenés permisos para eliminar.');
        }

        $gender = $this->model->getGenderById($id);
        if(!$gender) {
            return $this->view->showError("El genero con el id: $id, no existe");
        }

        $movies = $this->movieModel->getMoviesByGender($id);

        if(!empty($movies)) {
            return $this->view->showError('No se puede eliminar el genero porque tiene peliculas asociadas.');
        }
        
        $this->model->deleteGender($id);
        header("Location: " . BASE_URL . "genders");
    }
}
