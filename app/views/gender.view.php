<?php

class GenderView {

    function showGender($genres, $user) {
        require_once 'templates/layouts/header.phtml';
        require_once 'templates/gender.phtml';
        require_once 'templates/layouts/footer.phtml';
    }

    function showGenderFilms($filmsByGender, $user) {
        require_once 'templates/layouts/header.phtml';
        require_once 'templates/genderFilms.phtml';
        require_once 'templates/layouts/footer.phtml';
    }

    function showError($error) {
        require_once 'templates/layouts/header.phtml';
        require_once 'templates/error.phtml';
        require_once 'templates/layouts/footer.phtml';
    }

    function showAddGenderForm($user) {
        require 'templates/layouts/header.phtml';
        require 'templates/genderForm.phtml';
        require 'templates/layouts/footer.phtml';
    }

    function showEditGenderForm($gender, $user) {
        require 'templates/layouts/header.phtml';
        require 'templates/genderForm.phtml';
        require 'templates/layouts/footer.phtml';
    }
}