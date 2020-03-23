<?php


class AuthenticationService {

    public function __construct(){}

    public function authenticate($name,$password){
        $result = false;
        $exists = $_SERVER['ACCOUNT_REPO']->exists($name);
        if($exists){
            var_dump($_SERVER['ACCOUNT_REPO']->retrieve('name',$name));
            $account = $_SERVER['ACCOUNT_REPO']->retrieve('name',$name)[0];
            $correctHash = $account->getPassword();
            $providedHash = $this->hashPassword($password);
            $valid = $providedHash == $correctHash;
            if($valid){
                $result = $account;
            }
        }
        return $result;
    }
    public function hashPassword($plainText){
        return hash(PROP::HASH_ALG, $plainText);
    }

}