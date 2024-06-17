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
            'controller' => 'UserController',
            'action' => 'index'
        ];

        $routes['loginAuth'] = [
            'router' => '/login/auth',
            'controller' => 'UserController',
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
            'controller' => 'UserController',
            'action' => 'logout'
        ];

        $routes['admin'] = [
            'router' => '/admin',
            'controller' => 'AdminController',
            'action' => 'redirect'
        ];

        $routes['adminUsers'] = [
            'router' => '/admin/users',
            'controller' => 'AdminController',
            'action' => 'users'
        ];

        $routes['adminMateria'] = [
            'router' => '/admin/materias',
            'controller' => 'AdminController',
            'action' => 'Materias'
        ];

        $routes['adminMateriaAdd'] = [
            'router' => '/admin/materias/add',
            'controller' => 'AdminController',
            'action' => 'addMateria'
        ];

        $routes['adminSubMateria'] = [
            'router' => '/admin/submaterias',
            'controller' => 'AdminController',
            'action' => 'SubMaterias'
        ];

        $routes['adminSubMateriaAdd'] = [
            'router' => '/admin/submaterias/add',
            'controller' => 'AdminController',
            'action' => 'addSubMateria'
        ];

        $routes['addPerguntaForm'] = [
            'router' => '/pergunta/form',
            'controller' => 'UserController',
            'action' => 'formAddPergunta'
        ];

        $routes['addPergunta'] = [
            'router' => '/pergunta/add',
            'controller' => 'PerguntaController',
            'action' => 'addPergunta'
        ];

        $routes['getSubMaterias'] = [
            'router' => '/get/submaterias/materia/[0-9]+',
            'controller' => 'PerguntaController',
            'action' => 'returnSubmaterias'
        ];
        
        $this->routes = $routes;
    }
}
