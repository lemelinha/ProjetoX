<?php

namespace Needs\Controller;

abstract class Controller {
    protected function renderLayout($layout, $directory=''){        
        if (file_exists('../App/Layouts/' . $directory . '/' . $layout . '.php')){
            require '../App/Layouts/' . $directory . '/' . $layout . '.php';
        } else {
            echo "Layout $layout inexistente";
        }
    }
    
    protected function renderView($view, $directory=''){
        if (file_exists('../App/Views/' . $directory . '/' . $view . '.php')){
            require '../App/Views/' . $directory . '/' . $view . '.php';
        } else {
            echo "View $view inexistente";
        }
    }
}
