<?php

include_once 'app/models/gender.model.php';
include_once 'app/views/gender.view.php';

class GenderController {
    private $model;
    private $view;

    function __construct() {
        $this->model = new GenderModel();
        $this->view = new GenderView();
    }

    function showGender() {
        $gender =$this->model->getGender();
        $this->view->showGender($gender);
    }
}