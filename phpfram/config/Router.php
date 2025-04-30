<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Router {
    protected $routes = [];

    public function add($route, $controller, $method) {
        $this->routes[$route] = ['controller' => $controller, 'method' => $method];
    }

    public function match($url) {
        if (array_key_exists($url, $this->routes)) {
            return $this->routes[$url];
        }
        return false;
    }

    // Metode untuk mendefinisikan semua rute aplikasi.
    public function defineRoutes() {

        $this->add('', 'Home', 'index');
        
        $this->add('test', 'Test', 'index');
        $this->add('test/create', 'Test', 'create');
        $this->add('test/update', 'Test', 'update');
        $this->add('test/delete', 'Test', 'delete');


    }
}