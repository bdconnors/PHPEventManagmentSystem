<?php

class AuthenticationController {
    static public function index( $request, $response){
        $view = $_SERVER['TEMPLATE_SERVICE']->getLogin();
        $response->render($view);
    }
    static public function login( $request, $response){
        $service = $_SERVER['AUTHENTICATION_SERVICE'];
        $service->authenticate($request,$response);
    }
}