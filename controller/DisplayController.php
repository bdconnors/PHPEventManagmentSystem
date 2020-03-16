<?php

require_once('./view/LoginForm.php');
require_once('./view/Dashboard.php');
require_once('./view/CreateAccountForm.php');
class DisplayController{

    static public function login(Request $request,Response $response){
        $view = $_SERVER['TEMPLATE_SERVICE']->getLoginForm($request);
        $response->render($view);
    }
    static public function createAccount(Request $request,Response $response){
        $view = $_SERVER['TEMPLATE_SERVICE']->getAccountCreationForm($request);
        $response->render($view);
    }
    static public function dashboard(Request $request,Response $response){
        $view =$_SERVER['TEMPLATE_SERVICE']->getDashboardTemplate($request);
        $response->render($view);
    }
    static public function eventsPage(Request $request,Response $response){
        $view = $_SERVER['TEMPLATE_SERVICE']->getEventsTemplate($request);
        $response->render($view);
    }
    static public function venuesPage(Request $request,Response $response){
        $view = $_SERVER['TEMPLATE_SERVICE']->getVenuesTemplate($request);
        $response->render($view);
    }

}