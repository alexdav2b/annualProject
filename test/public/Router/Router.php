<?php

require_once __DIR__ . '/Route.php';

Class Router{
    private $url;
    private $routes = [];
    private $namedRoutes = [];

    public function __construct($url){
        $this->url = $url;
    }

    public function get($path, $callable, $name = null){
        return $this->add($path, $callable, $name, 'GET');
    }

    public function post($path, $callable, $name = null){
        return $this->add($path, $callable, $name, 'POST');
    }

    private function add($path, $callable, $name, $method){
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if(is_string($callable) && $name === null){
            $name = $callable;
        }
        if($name){
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }
    
    public function url($name, $params = []){
        if(!isset($this->namedRoute[$name])){
            throw new Exception();
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }
    // public function put($path, $callable){
    //     $route = new Route($path, $callable);
    //     $this->routes['PUT'][] = $route;
    // }

    // public function delete($path, $callable){
    //     $route = new Route($path, $callable);
    //     $this->routes['DELETE'][] = $route;
    // }

    public function run(){
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new Exception();
        }
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
            if($route->match($this->url)){
                return $route->call();
            }
        }
        // throw new Exception();
    }

}