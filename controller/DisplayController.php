<?php

require_once('./view/LoginForm.php');
require_once('./view/Dashboard.php');
require_once('./view/CreateAccountForm.php');
class DisplayController{

    static public function login(Request $request,Response $response){
        $response->send(LoginForm::render());
    }
    static public function createAccount(Request $request,Response $response){
        $response->send(CreateAccountForm::render(array('user'=>$_SESSION['account'])));
    }
    static public function dashboard(Request $request,Response $response){
        $response->send(Dashboard::render(array('user'=>$_SESSION['account'])));
    }

}