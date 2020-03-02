<?php

require_once'./abstraction/Service.php';
class LoginService extends Service {
    public function __construct($repo){
        parent::__construct($repo);
    }
    public function authenticate($name,$password){
        $verified = false;
        $user = $this->repo->retrieve(PROP::USER_NAME,'name',$name);
        if($user) {
            $expectedHash = $user->getPassword();
            $providedHash = $this->hashPassword($password);
            $verified = $providedHash == $expectedHash;
            if($verified){
                $verified = $user;
            }
        }
        return $verified;
    }
    public function hashPassword($plainText){
        return hash(PROP::HASH_ALG, $plainText);
    }
}