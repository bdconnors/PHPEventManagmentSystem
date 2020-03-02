<?php
require_once('./util/Response.php');
class Router{
    public $request;
    public $routes;
    function __construct(IRequest $request){
        $this->request = $request;
        $this->routes = array(
            'GET'=>array(),
            'POST'=>array(),
            'PUT'=>array(),
            'DELETE'=>array()
        );
    }
    public function get($route,$controller,$function){
        $this->routes['GET'][$route] = array($controller,$function);
    }
    public function post($route,$controller,$function){
        $this->routes['POST'][$route] = array($controller,$function);
    }
    public function put($route,$controller,$function){
        $this->routes['PUT'][$route] = array($controller,$function);
    }
    public function delete($route,$controller,$function){
        $this->routes['DELETE'][$route] = array($controller,$function);
    }
    function resolve(){
        $method = $this->request->method;
        $path = $this->request->getPath();
        $action = $this->routes[$method][$path];
        call_user_func_array($action,array($this->request,new Response()));
    }
    function __destruct(){
        $this->resolve();
    }



}