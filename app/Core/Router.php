<?php
namespace App\Core;
use \App\Core\Request;
use \App\Core\Bootstrap;
use \App\Core\Exception\NotFoundException;

class Router {

    public function __construct(public Bootstrap $bootstrap) {}

    public function getRoute() {
        $method = $this->bootstrap->request->getRequestMethod();
        $path = $this->bootstrap->request->getRequestPath();
        $routes = $this->bootstrap->config['routes'];
        return $routes[$method][$path] ?? false;
    }

    public function resolve() {
        $response = $this->getRoute();
        if(!$response) throw new NotFoundException();
        $this->dispatch($response);
    }

    public function dispatch($response) {
        $controller = $response[0];
        $action = $response[1];
        $instance = new $controller($this->bootstrap);
        $this->bootstrap->middleware->execute();
        call_user_func_array([$instance, $action], []);
    }

}