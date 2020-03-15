<?php
require_once('./util/Response.php');
class Router{
    public $routes;
    function __construct(){
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
    function resolve(IRequest $request,IResponse $response){
        $method = $request->method;
        $path = $request->getPath();
        if($request->validSession() || $request->loginRequest()) {
            if (isset($this->routes[$method][$path])) {
                $action = $this->routes[$method][$path];
                call_user_func_array($action, array($request, $response));
            }
        }else{
            $request->destroySession();
            $response->redirect('/login');
        }
    }

}