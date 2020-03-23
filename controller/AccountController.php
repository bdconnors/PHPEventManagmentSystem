<?php


class AccountController
{
    static public function index(IRequest $request,IResponse $response){
        $user = $request->getUser();
        if($request->hasParam('id')) {
            $id = $request->query('id');
            $valid = $_SERVER['VALIDATION']->validatePosInteger($id);
            if($valid){
                $account = $_SERVER['ACCOUNT_REPO']->retrieve('id',$id);
                $view = $_SERVER['TEMPLATE_SERVICE']->getProfile('ACCOUNT',$user,$account);
                $response->render($view);
            }else{
                $view = $_SERVER['TEMPLATE_SERVICE']->getError('Page Not Found');
                $response->render($view);
            }
        }else{
            $accounts = $_SERVER['ACCOUNT_REPO']->retrieveAll();
            $view = $_SERVER['TEMPLATE_SERVICE']->getList('ACCOUNT',$user,$accounts);
            $response->render($view);
        }
    }
    static public function createForm(IRequest $request,IResponse $response){
        $view = $_SERVER['TEMPLATE_SERVICE']->getCreateAccount($request->getUser());
        $response->render($view);
    }
    static public function create(IRequest $request,IResponse $response){
        $service = $_SERVER['ADMIN_SERVICE'];
        $service->createAccount($request,$response);
    }
    static public function delete(IRequest $request,IResponse $response){
        $service = $_SERVER['ADMIN_SERVICE'];
        $service->deleteAccount($request,$response);
    }
}