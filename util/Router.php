<?php
require_once('./util/Response.php');
class Router{
    public $routes;
    protected $auth;
    function __construct($auth){
        $this->auth = $auth;
        $this->routes = array(
            'GET'=>array(),
            'POST'=>array(),
            'PUT'=>array(),
            'DELETE'=>array()
        );
    }
    public function get($path,$controller,$function,$permissionLevel){
        $this->addRoute('GET',$path,$controller,$function,$permissionLevel);
    }
    public function post($path,$controller,$function,$permissionLevel){
        $this->addRoute('POST',$path,$controller,$function,$permissionLevel);
    }
    public function put($path,$controller,$function,$permissionLevel){
        $this->addRoute('PUT',$path,$controller,$function,$permissionLevel);
    }
    public function delete($path,$controller,$function,$permissionLevel){
        $this->addRoute('DELETE',$path,$controller,$function,$permissionLevel);
    }
    protected function addRoute($method,$path,$controller,$function,$permissionLevel){
        $this->routes[$method][$path] = new Route($path,$controller,$function,$permissionLevel);
    }
    public function resolve($request, $response){
        $method = $request->method;
        $path = $request->getPath();
        if (isset($this->routes[$method][$path])) {
            $route = $this->routes[$method][$path];
            $this->auth->authorize($route,$request,$response);
        }else{
            var_dump($request);
        }
    }

}