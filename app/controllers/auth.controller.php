<?php

require_once 'app/models/user.model.php';
require_once 'app/views/auth.view.php';


class AuthController {

    private $model;
    private $view;

    function __construct() {
        $this->model = new UserModel();
        $this->view = new UserView();
    }

    function showLogin() {
        $this->view->showLogin();
    }

    function login() {
        //verifico los datos y logueo el administrador
        if(empty($_POST['username']) || empty($_POST['password'])) {
            return $this->view->showError("Faltan completar datos obligatorios");
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        // verificar que el usuario esta en la DB
        $userFromDB =$this->model->getUser($username);

        if($userFromDB && password_verify($password, $userFromDB->password)) {
            // guardamos los datos del usuario en session
            $_SESSION['USER_ID'] = $userFromDB->id;
            $_SESSION['USER_NAME'] = $userFromDB->usuario;

            //redirijo al panel admin
            header('Location:' . BASE_URL . 'home');
            return;
        } else {
            return $this->view->showLogin("Usuraio o contraseña incorrecto");
        }

    }

}