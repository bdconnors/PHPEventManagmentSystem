<?php


class Authorization {

    public function __construct(){}

    public function authorize(Route $route,IRequest $request,IResponse $response){
        $public = $route->permission == 5;
        $hasSession = $request->validSession();
        if($public){
            $route->resolve($request,$response);
        }else if($hasSession){
            $permissionLevel = $request->getUser()->role->id;
            $authorized = $permissionLevel <= $route->permission;
            if($authorized){
                $route->resolve($request,$response);
            }else{
                $response->redirect('/');
            }
        }else {
            $request->destroySession();
            $response->redirect('/login');
        }

    }
}