<?php

namespace App\Controllers;
use Needs\Controller\Controller;
use App\Models\Materias;
use App\Models\Pergunta;

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

    public function Crud($data) {
        try {
            switch ($data['type']) {
                case 'pergunta':
                    $PerguntaModel = new Pergunta();
                    
                    if ($data['crud'] == 'delete') {
                        $PerguntaModel->deletePergunta($data['id']);
                    }
    
                    break;
                case 'materia':
                    $MateriaModel = new Materias();

                    if ($data['crud'] == 'delete') {
                        $MateriaModel->deleteMateria($data['id']); 
                    }
    
                    break;
                case 'submateria':
                    $MateriaModel = new Materias();

                    if ($data['crud'] == 'delete') {
                        $MateriaModel->deleteSubMateria($data['id']); 
                    }

                    break;
                default:
                    echo json_encode(['erro' => false]);
                    break;
            }
            echo json_encode(['erro' => false]);
        } catch (Exception $e) {
            echo json_encode(['erro' => true]);
        }
    }
}
