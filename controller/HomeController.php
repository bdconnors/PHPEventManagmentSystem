<?php

class HomeController{
    static public function index( $request, $response){
        $view =$_SERVER['TEMPLATE_SERVICE']->getHomePage($request->getUser());
        $response->render($view);
    }
}