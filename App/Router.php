<?php

namespace App;

/**
 *  Classe referente às rotas do projeto.
 * 
 */
abstract class Router {
    /**
     *  Função de declaração de rotas
     * 
     *  Esta função declara as rotas do projeto e
     *  armazena no atributo 'routes' da instância
     * 
     *  @return void
     */
    protected function declareRoutes(){
        $routes['index'] = [
            'router' => '/',
            'controller' => 'IndexController',
            'action' => 'index'
        ];

        $routes['login'] = [
            'router' => '/login',
            'controller' => 'LoginController',
            'action' => 'index'
        ];

        $routes['loginAuth'] = [
            'router' => '/login/auth',
            'controller' => 'LoginController',
            'action' => 'authLogin'
        ];

        $routes['registerForm'] = [
            'router' => '/register',
            'controller' => 'RegisterController',
            'action' => 'index'
        ];

        $routes['register'] = [
            'router' => '/register/register',
            'controller' => 'RegisterController',
            'action' => 'register'
        ];

        $routes['logout'] = [
            'router' => '/logout',
            'controller' => 'LoginController',
            'action' => 'logout'
        ];
        
        $this->routes = $routes;
    }
}
