<?php

class AuthenticationController {
    static public function index(IRequest $request,IResponse $response){
        $view = $_SERVER['TEMPLATE_SERVICE']->getLogin();
        $response->render($view);
    }
    static public function login(IRequest $request,IResponse $response){
        $service = $_SERVER['AUTHENTICATION_SERVICE'];
        $service->authenticate($request,$response);
    }
}