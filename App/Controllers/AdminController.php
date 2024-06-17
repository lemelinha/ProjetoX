<?php

namespace App\Controllers;
use Needs\Controller\Controller;
use App\Models\Materias;

class AdminController extends Controller {
    public function __construct() {
        if (!isset($_SESSION['logged']) || $_SESSION['logged']['user'] != $_ENV['ADMIN_USER']){
            header('Location: /');
            die();
        }
    }

    public function redirect() {
        header('Location: /admin/materias');
        die();
    }

    public function Materias() {
        $this->pageTitle = 'Matérias';

        $MateriaModel = new Materias();
        $this->materias = $MateriaModel->returnMaterias();

        $this->render('materias', 'AdminLayout', 'Admin');
    }

    public function addMateria() {
        $materia = $_POST['materia']??null;

        $MateriaModel = new Materias();
        $MateriaModel->addMateria($materia);
        echo json_encode(['erro' => false]);
    }

    public function SubMaterias() {
        $this->pageTitle = 'SubMatérias';

        $MateriaModel = new Materias();
        $this->materias = $MateriaModel->returnMaterias();

        $this->submaterias = $MateriaModel->returnSubMaterias();
        
        $this->render('subMaterias', 'AdminLayout', 'Admin');
    }

    public function addSubMateria() {
        $submateria = $_POST['submateria']??null;
        $materia = $_POST['materiaPai']??null;

        $MateriaModel = new Materias();
        $MateriaModel->addSubMateria($submateria, $materia);
        echo json_encode(['erro' => false]);
    }
}
