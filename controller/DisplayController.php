<?php

require_once('./view/LoginForm.php');
require_once('./view/Dashboard.php');
require_once('./view/RegistrationForm.php');
class DisplayController{

    static public function displayLogin(Request $request,Response $response){
        $response->send(LoginForm::render());
    }
    static public function displayRegistration(Request $request,Response $response){
        $response->send(RegistrationForm::render());
    }
    static public function displayDashboard(Request $request,Response $response){
        $response->send(Dashboard::render(array('user'=>$_SESSION['account'])));
    }

}