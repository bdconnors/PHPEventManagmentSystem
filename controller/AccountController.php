<?php


class AccountController
{
    static public function index( $request, $response){

        $user = $request->getUser();
        if($request->hasParam('id')) {
            $id = $request->query('id');
            $valid = $_SERVER['VALIDATION']->validatePosInteger($id);
            if($valid){
                $account = $_SERVER['ACCOUNT_REPO']->retrieve('id',$id)[0];
                $registrations = $_SERVER['REGISTRATION_REPO']->retrieve('attendee',$id);
                $item = array('account'=>$account,'registrations'=>$registrations);
                $view = $_SERVER['TEMPLATE_SERVICE']->getProfile('ACCOUNT',$user,$item);
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
    static public function createForm( $request, $response){
        $view = $_SERVER['TEMPLATE_SERVICE']->getCreateAccount($request->getUser());
        $response->render($view);
    }
    static public function updateForm( $request, $response){
        $user = $request->getUser();
        if($request->hasParam('id')) {
            $id = $request->query('id');
            $valid = $_SERVER['VALIDATION']->validatePosInteger($id);
            if($valid){
                $account = $_SERVER['ACCOUNT_REPO']->retrieve('id',$id)[0];
                $view = $_SERVER['TEMPLATE_SERVICE']->getEditAccount($user,$account);
                $response->render($view);
            }else{
                $view = $_SERVER['TEMPLATE_SERVICE']->getError('Page Not Found');
                $response->render($view);
            }
        }else{
            $response->redirect('/accounts');
        }
    }
    static public function update( $request, $response){
        $service = $_SERVER['ACCOUNT_SERVICE'];
        $service->update($request,$response);
    }
    static public function create( $request, $response){
        $service = $_SERVER['ACCOUNT_SERVICE'];
        $service->create($request,$response);
    }
    static public function delete( $request, $response){
        $service = $_SERVER['ACCOUNT_SERVICE'];
        $service->delete($request,$response);
    }
}