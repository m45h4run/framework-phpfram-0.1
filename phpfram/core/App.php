<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once BASEPATH.'/BaseController.php';
require_once BASEPATH.'/BaseModel.php';
require_once 'config/Router.php';
$router = new Router();
$router->defineRoutes();

$url = isset($_GET['url']) ? $_GET['url'] : '';
$route = $router->match($url);

if ($route) {
    $controllerName = $route['controller'];
    $methodName = $route['method'];

    require_once APPPATH.'/controllers/' . $controllerName . '.php';
    $controller = new $controllerName();

    $params = [];
    if (preg_match_all('/\/([^\/]+)/', $url, $matches)) {
        array_shift($matches);
        $params = $matches[0];
    }

    call_user_func_array([$controller, $methodName], $params);
} else {
    echo "404 Not Found";
}