<?php

class UserView {

    function showLogin($error, $user) {
        require_once 'templates/layouts/header.phtml';
        require_once 'templates/form_login.phtml';
        require_once 'templates/layouts/footer.phtml';
    }

    function showError($error) {
        require_once 'templates/layouts/header.phtml';
        require_once 'templates/error.phtml';
        require_once 'templates/layouts/footer.phtml';
    }
}