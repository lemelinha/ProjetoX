<?php

namespace App\Controllers;
use Needs\Controller\Controller;

class IndexController extends Controller {
    public function index() {
        $this->pageTitle = 'ProjetoX';
        $this->render('index', 'MainLayout');
    }
}
