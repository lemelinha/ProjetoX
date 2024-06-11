<?php

namespace App\Controllers;
use Needs\Controller\Controller;
use Models\Login;

class LoginController extends Controller {
    public function index() {
        $this->pageTitle = 'Login';
        $this->renderView('login.php');
    }

    public function authLogin(){
        $userOrEmail = $_POST['identifier']??null;
        $password = $_POST['password']??null;

        $LoginModel = new Login();
        if ($LoginModel->authLogin($userOrEmail, $password)){
            header('Location: /');
            die();
        }

        if ($LoginModel->authLoginAdmin()) {
            header('Location: /');
            die();
        }

        die();
    }
}
