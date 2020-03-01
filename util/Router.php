<?php
require_once('./util/Response.php');
class Router{
    public $request;
    public $routes;
    function __construct(IRequest $request){
        $this->request = $request;
        $this->routes = array(
            'GET'=>[],
            'POST'=>[],
            'PUT'=>[],
            'DELETE'=>[]
        );
    }
    public function get($route,$controller,$method){
        $this->routes['GET'][$route] = array($controller,$method);
    }
    public function post($route,$controller,$method,$params){
        $this->routes['POST'][$route] = array($controller,$method);
    }
    public function put($route,$controller,$method){
        $this->routes['PUT'][$route] = array($controller,$method);
    }
    public function delete($route,$controller,$method){
        $this->routes['DELETE'][$route] = array($controller,$method);
    }
    function resolve(){
        $route = $this->routes[$this->request->method][$this->request->url];
        call_user_func_array($route,array('request'=>$this->request,'response'=>new Response()));
    }
    function __destruct(){
        $this->resolve();
    }



}