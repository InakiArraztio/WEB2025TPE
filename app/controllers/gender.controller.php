<?php
require_once 'app/models/gender.model.php';
require_once 'app/views/gender.view.php';

class GenderController {
    private $model;
    private $view;

    function __construct() {
        $this->model = new GenderModel();
        $this->view = new GenderView();
    }

   
    function showGender($request) {
        $genders = $this->model->getGender();
        $this->view->showGender($genders, $request->user);
    }

    
    function filmsByGender($id, $request) {
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

        $nombre = $_POST['genero'];
        $this->model->updateGender($id, $nombre);
        header("Location: " . BASE_URL . "genders");
    }

    
    function deleteGender($id, $request) {
        if (!$request->user) {
            return $this->view->showError('No tenés permisos para eliminar.');
        }
        
        $this->model->deleteGender($id);
        header("Location: " . BASE_URL . "genders");
    }
}
