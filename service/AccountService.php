<?php

require_once('./abstraction/Service.php');
class AccountService extends Service
{
    private Validation $validation;
    public function __construct(Repository $repo,Validation $validation){
        parent::__construct($repo);
        $this->validation = $validation;
    }
    public function retrieveAll(){
        return $this->repo->retrieveAll();
    }
    public function create(Request $request,Response $response){
        $body = $request->getBody();
        $password = $body[PROP::PASSWORD];
        $name = $body[PROP::NAME];
        $role = 3;
        if(isset($body[PROP::ROLE])){$role = $body[PROP::ROLE];}
        $validName = $this->validation->validateAlphaNumeric($name);
        $validPass = $this->validation->validateAlphaNumeric($password);
        $validRole =  $validName = $this->validation->validateNumber($role);
        if($validName && $validPass && $validRole) {
            $hash = $this->hashPassword($body[PROP::PASSWORD]);
            $values = array('name' => $name, 'password' => $hash, 'role' => $role);
            $account = $this->repo->create($values);
            $response->sendJSON($account);
        }else{
            $response->send(CreateAccountForm::render(array('err'=>'Invalid user name or password')));
        }
    }
    public function retrieve(Request $request,Response $response){
        if($request->hasParam('id')) {
            $id = $request->query('id');
            if($this->validation->validateNumber($id)) {
                $account = $this->repo->retrieve('id', $id)[0];
                $response->sendJSON($account);
            }else{
                $response->sendJSON('Invalid Account ID');

            }
        }else{
            $response->sendJSON('Account ID required to retrieve ');
        }
    }
    public function update(Request $request,Response $response){
        if($request->hasParam('id')) {
            $id = $request->query('id');
            if($this->validation->validateNumber($id)) {
                $account = $this->repo->retrieve('id', $id)[0];
                $response->sendJSON($account);
                $body = $request->getBody();
                if(isset($body[PROP::PASSWORD])){
                    $values[PROP::PASSWORD] = $this->hashPassword($body[PROP::PASSWORD]);
                }
                $response->sendJSON($this->repo->update($id,$body));
            }else{
                $response->sendJSON('Invalid Account ID');
            }
        }else{
            $response->sendJSON('Account ID required to update');
        }

    }
    public function delete(Request $request,Response $response){
        if($request->hasParam('id')) {
            $id = $request->query('id');
            if($this->validation->validateNumber($id)) {
                $response->sendJSON($this->repo->delete(PROP::USER_ID, $id));
            }else{
                $response->sendJSON('Invalid Account ID');
            }
        }else{
            $response->sendJSON('Account ID required to delete');
        }
    }
    public function authenticate(Request $request,Response $response){
        $valid = false;
        $body = $request->getBody();
        $name = $body['name'];
        $password = $body['password'];
        $account = $this->repo->retrieve('name',$name)[0];
        if($account){
            $correctHash = $account->getPassword();
            $providedHash = $this->hashPassword($password);
            $valid = $providedHash == $correctHash;
        }
        if($valid){
            $request->createSession($account);
            $response->redirect('/dashboard');
        }else{
            $response->send(LoginForm::render(array('err'=>'Incorrect user name or password')));
        }
    }
    public function hashPassword($plainText){
        return hash(PROP::HASH_ALG, $plainText);
    }
    function hasValidSession(){
        $valid = false;
        if(!empty($_SESSION['loggedIn'])){
            $valid = $_SESSION['loggedIn'];
        }
        return $valid;
    }


}