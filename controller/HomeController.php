<?php

class HomeController{
    static public function index(IRequest $request,IResponse $response){
        $view =$_SERVER['TEMPLATE_SERVICE']->getHomePage($request->getUser());
        $response->render($view);
    }
}