<?php

class AuthenticationController {
    static public function login(Request $request,Response $response){
        $service = $_SERVER['AUTHENTICATION_SERVICE'];
        $service->authenticate($request,$response);
    }
    static public function createAccount(Request $request,Response $response){
        $service = $_SERVER['ACCOUNT_SERVICE'];
        $service->create($request,$response);
    }
}