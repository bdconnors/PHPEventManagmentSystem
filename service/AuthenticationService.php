<?php


class AuthenticationService {

    public function __construct(){}

    public function authenticate( $request, $response){
        $body = $request->getBody();
        $validName = $_SERVER['VALIDATION']->validateAlphaNumeric($body['name']);
        $validPass = $_SERVER['VALIDATION']->validateAlphaNumeric($body['password']);
        $valid = $validName && $validPass;
        if($valid) {
            $exists = $_SERVER['ACCOUNT_REPO']->exists($body['name']);
            if ($exists) {
                $account = $_SERVER['ACCOUNT_REPO']->retrieve('name', $body['name'])[0];
                $correctHash = $account->getPassword();
                $providedHash = $this->hashPassword($body['password']);
                $authenticated = $providedHash == $correctHash;
                if ($authenticated) {
                    $request->createSession($account);
                    $response->redirect('/');
                }else{
                    $view = $_SERVER['TEMPLATE_SERVICE']->getLogin('Incorrect account name or password');
                    $response->render($view);
                }
            }else{
                $view = $_SERVER['TEMPLATE_SERVICE']->getLogin('Incorrect account name or password');
                $response->render($view);
            }
        }
    }
    public function hashPassword($plainText){
        return hash(PROP::HASH_ALG, $plainText);
    }

}