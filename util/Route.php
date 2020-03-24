<?php


class Route {
    public $path;
    public $controller;
    public $function;
    public $permission;
    public function __construct($path,$controller,$function,$permission){
        $this->path = $path;
        $this->controller = $controller;
        $this->function = $function;
        $this->permission = $permission;
    }
    public function resolve($request, $response){
        call_user_func_array(array($this->controller,$this->function), array($request, $response));
    }
}