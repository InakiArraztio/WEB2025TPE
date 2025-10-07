<?php

class GenderView {

    function showGender($genres) {
        require_once 'templates/layouts/header.phtml';
        require_once 'templates/gender.phtml';
        require_once 'templates/layouts/footer.phtml';
    }

    function showGenderFilms($filmsByGender) {
        require_once 'templates/layouts/header.phtml';
        require_once 'templates/genderFilms.phtml';
        require_once 'templates/layouts/footer.phtml';
    }
}