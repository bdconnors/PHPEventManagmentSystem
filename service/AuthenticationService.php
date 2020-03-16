<?php


class AuthenticationService {
    private Validation $validation;
    public function __construct(Validation $validation){
        $this->validation = $validation;
    }
    public function authenticate(IRequest $request,IResponse $response){
        $valid = false;
        $body = $request->getBody();
        $name = $body['name'];
        $password = $body['password'];
        $searchResult = $_SERVER['ACCOUNT_REPO']->retrieve('name',$name);
        if(!empty($searchResult[0])){
            $correctHash = $searchResult[0]->getPassword();
            $providedHash = $this->hashPassword($password);
            $valid = $providedHash == $correctHash;
        }
        if($valid){
            $request->createSession($searchResult[0]);
            $response->redirect('/dashboard');
        }else{
            $response->render(new LoginForm('Incorrect user name or password'));
        }
    }
    public function hashPassword($plainText){
        return hash(PROP::HASH_ALG, $plainText);
    }

}