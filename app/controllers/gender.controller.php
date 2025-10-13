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

   
    function showGender() {
        $genders = $this->model->getGender();
        $this->view->showGender($genders);
    }

    
    function filmsByGender($id) {
        $filmsByGender = $this->model->filmsGender($id);
        $this->view->showGenderFilms($filmsByGender);
    }

    
    function addGender() {
        require_once 'templates/layouts/header.phtml';
        require_once 'templates/genderForm.phtml';
        require_once 'templates/layouts/footer.phtml';
    }

   
    function insertGender() {
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

    
    function editGender($id) {
        $gender = $this->model->getGenderById($id);
        if (!$gender) {
            $this->view->showError('No existe el género seleccionado.');
            return;
        }

        require_once 'templates/layouts/header.phtml';
        require_once 'templates/genderForm.phtml'; 
        require_once 'templates/layouts/footer.phtml';
    }

   
    function updateGender($id) {
        if (empty($_POST['genero'])) {
            $this->view->showError('⚠️ Falta completar el campo.');
            return;
        }

        $nombre = $_POST['genero'];
        $this->model->updateGender($id, $nombre);
        header("Location: " . BASE_URL . "genders");
    }

    
    function deleteGender($id) {
        $this->model->deleteGender($id);
        header("Location: " . BASE_URL . "genders");
    }
}
