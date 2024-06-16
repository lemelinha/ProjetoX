<?php

namespace App\Controllers;
use Needs\Controller\Controller;
use App\Models\Register;
use App\Tools\Tools;

class RegisterController extends Controller {
    public function index() {
        $this->pageTitle = 'Registro';
        $this->renderView('register');
    }

    public function register() {
        $user = $_POST['user']??null;
        $email = $_POST['email']??null;
        $password = $_POST['password']??null;
        
        if (Tools::usernameOrEmailExists($user, $email)){
            echo json_encode(['error' => 'Usuário ou email já cadastrados']);
            die();
        }

        $RegisterModel = new Register();

        $RegisterModel->register($user, $email, $password);
        echo json_encode(['register' => true]);
    }
}
