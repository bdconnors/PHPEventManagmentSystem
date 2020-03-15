<?php
require_once('./repo/AccountRepository.php');
require_once('./service/AccountService.php');
require_once('./util/Validation.php');
require_once('./util/Sanitization.php');

class AccountController {
    static public function login(Request $request,Response $response){
        $service = $_SERVER['ACCOUNT_SERVICE'];
        $service->authenticate($request,$response);
    }
    static public function retrieveAccount(Request $request,Response $response){
        $service = $_SERVER['ACCOUNT_SERVICE'];
        $service->retrieve($request,$response);
    }
    static public function createAccount(Request $request,Response $response){
        $service = $_SERVER['ACCOUNT_SERVICE'];
        $service->create($request,$response);
    }
    static public function deleteAccount(Request $request,Response $response){
        $service = $_SERVER['ACCOUNT_SERVICE'];
        $service->delete($request,$response);
    }
    static public function updateAccount(Request $request,Response $response){
        $service = $_SERVER['ACCOUNT_SERVICE'];
        $service->update($request,$response);
    }

}