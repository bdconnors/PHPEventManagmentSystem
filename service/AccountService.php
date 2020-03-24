<?php

class AccountService{
    public function __construct(){}
    public function create(IRequest $request,IResponse $response){
        $body = $request->getBody();
        $validation = $_SERVER['VALIDATION'];
        $validName = $validation->validateAlphaNumeric($body['name']);
        $validPass = $validation->validateAlphaNumeric($body['password']);
        $validRole = $validation->validatePosInteger($body['role']);
        if($validName && $validPass && $validRole) {
            $_SERVER['ACCOUNT_REPO']->create($body);
            $response->redirect('/accounts');
        }else{
            $response->send(new CreateAccountForm('Invalid user name or password'));
        }
    }
    public function retrieve(IRequest $request,IResponse $response){
        if($request->hasParam('id')) {
            $id = $request->query('id');
            $validation = $_SERVER['VALIDATION'];
            if($validation->validatePosInteger($id)) {
                $account = $_SERVER['ACCOUNT_REPO']->retrieve('id', $id)[0];
                $response->sendJSON($account);
            }else{
                $response->sendJSON('Invalid Account ID');
            }
        }else{
            $response->sendJSON('Account ID required to retrieve ');
        }
    }
    public function update(IRequest $request,IResponse $response){

        if($request->hasParam('id')) {
            $id = $request->query('id');
            $validation = $_SERVER['VALIDATION'];
            if($validation->validatePosInteger($id)) {
                $body = $request->getBody();
                $_SERVER['ACCOUNT_REPO']->update($body);
                $response->redirect('/accounts');
            }else{
                $response->sendJSON('Invalid Account ID');
            }
        }else{
            $response->sendJSON('Account ID required to update');
        }

    }
    public function delete(IRequest $request,IResponse $response){
        $id = $request->getBody()['id'];
        $validation = $_SERVER['VALIDATION'];
        if($validation->validatePosInteger($id)) {
            $response->sendJSON($_SERVER['ACCOUNT_REPO']->delete($id));
            $response->redirect('/accounts');
        }else{
            $response->sendJSON('Invalid Account ID');
        }

    }

}