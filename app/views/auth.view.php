<?php

class UserView {

    function showLogin() {
        require_once 'templates/layouts/header.phtml';
        require_once 'templates/auth/login.phtml';
        require_once 'templates/layouts/footer.phtml';
    }

    function showError($error) {
        require_once 'templates/layouts/header.phtml';
        require_once 'templates/error.phtml';
        require_once 'templates/layouts/footer.phtml';
    }
}