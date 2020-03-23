<?php

class AuthenticationController {
    static public function index(IRequest $request,IResponse $response){
        $view = $_SERVER['TEMPLATE_SERVICE']->getLogin();
        $response->render($view);
    }
    static public function login(IRequest $request,IResponse $response){
        $service = $_SERVER['AUTHENTICATION_SERVICE'];
        $body = $request->getBody();
        $name = $body['name'];
        $password = $body['password'];
        $sanitizedName = $_SERVER['VALIDATION']->validateAlphaNumeric($name);
        $sanitizedPass = $_SERVER['VALIDATION']->validateAlphaNumeric($password);
        if($sanitizedName && $sanitizedPass) {
            $result = $service->authenticate($body['name'], $body['password']);
            if ($result != false) {
                $request->createSession($result);
                $response->redirect('/');
            } else {
                $err = $_SERVER['TEMPLATE_SERVICE']->getLogin('Incorrect user name or password');
                $response->render($err);
            }
        }else {
            $err = $_SERVER['TEMPLATE_SERVICE']->getLogin('Incorrect user name or password');
            $response->render($err);
        }
    }
}