<?php

require_once 'app/models/user.model.php';
require_once 'app/views/auth.view.php';


class AuthController {
    private $userModel;
    private $view;

    function __construct() {
        $this->userModel = new UserModel();
        $this->view = new UserView();
    }

    function showLogin($request) {
        $this->view->showLogin("", $request->user);
    }

    function login($request) {
        //verifico los datos y logueo el administrador
        if(empty($_POST['user']) || empty($_POST['password'])) {
            return $this->view->showError("Faltan completar datos obligatorios", $request->user);
        }

        $username = $_POST['user'];
        $password = $_POST['password'];

        // verificar que el usuario esta en la DB
        $userFromDB =$this->userModel->getByUser($username);

        if($userFromDB && password_verify($password, $userFromDB->password)) {
            
            // guardamos los datos del usuario en session
            $_SESSION['USER_ID'] = $userFromDB->id_user;
            $_SESSION['USER_NAME'] = $userFromDB->user;
            //redirijo al panel admin
            header('Location:' . BASE_URL . 'home');
            return;
        } else {
            return $this->view->showLogin("Usuario o contraseña incorrecto", $request->user);
        }

    }

    function logout($request) {
        session_destroy();
        header('Location:' . BASE_URL . "showLogin");
        return;
    }

}