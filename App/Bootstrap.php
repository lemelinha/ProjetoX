<?php

namespace App;
use Dotenv\Dotenv;

class Bootstrap extends Router{
    public function __construct(){
        $this->loadEnvironmentVariables();

        $this->declareRoutes();

        $uri = $this->getUri();
        $this->run($uri);
    }
    
    private function run($uri){
        foreach($this->routes as $key => $router){
            if ($uri == $router['router']){
                $controllerClass = 'App\\Controllers\\' . $router['controller'];
                $action = $router['action'];

                $controllerInstance = new $controllerClass();
                $controllerInstance->$action();
                die();
            } 
        }

        require 'Views/erro.php';
    }
    
    private function getUri(){
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if(str_ends_with($uri, '/') && $uri != '/') {
            $uri = rtrim($uri, '/');
            header("Location: $uri");
            die();
        }
        return $uri;
    }

    private function loadEnvironmentVariables(){
        $dotenv = Dotenv::createImmutable(dirname(__FILE__, 2));
        $dotenv->load();
    }
}
