<?php

require_once'./view/LoginForm.php';
require_once'./view/RegistrationForm.php';
class HomeController {

    static public function displayLogin(Request $request,Response $response){
        $response->send(LoginForm::render());
    }

    static public function displayRegistration(Request $request,Response $response){
        $response->send(RegistrationForm::render());
    }

}