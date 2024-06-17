<?php

namespace App\Controllers;
use Needs\Controller\Controller;
use App\Models\Login;
use App\Models\Materias;

class UserController extends Controller {
    public function index() {
        $this->pageTitle = 'Login';
        $this->renderView('login');
    }

    public function authLogin(){
        $identifier = $_POST['identifier']??null;
        $password = $_POST['password']??null;

        $LoginModel = new Login();
        if ($LoginModel->authLogin($identifier, $password)){
            echo json_encode(['auth' => true]);
            die();
        }

        if ($LoginModel->authLoginAdmin($identifier, $password)) {
            echo json_encode(['auth' => true]);
            die();
        }

        echo json_encode(['auth' => false]);
        die();
    }

    public function logout() {
        unset($_SESSION['logged']);
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 84000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        header("Location: /");
    }

    public function formAddPergunta() {
        $this->pageTitle = 'Adicionar Pergunta';

        $MateriaModel = new Materias();
        $this->materias = $MateriaModel->returnMaterias();
        $this->submaterias = $MateriaModel->returnSubMaterias();

        $this->render('formAddPergunta', 'MainLayout');
    }
}
