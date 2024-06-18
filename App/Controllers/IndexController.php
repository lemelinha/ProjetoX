<?php

namespace App\Controllers;
use Needs\Controller\Controller;
use App\Models\Materias;

class IndexController extends Controller {
    public function index() {
        $this->pageTitle = 'ProjetoX';

        $MateriaModel = new Materias();
        
        $this->materias = $MateriaModel->returnMaterias();
        $this->submaterias = $MateriaModel->returnSubMaterias();

        $this->render('index', 'MainLayout');
    }
}
