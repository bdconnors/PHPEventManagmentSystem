<?php

class AdminService{
    private Validation $validation;
    public function __construct(Validation $validation){
        $this->validation = $validation;
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
            $account = $_SERVER['ACCOUNT_REPO']->create($values);
            $response->sendJSON($account);
        }else{
            $response->send(new CreateAccountForm('Invalid user name or password'));
        }
    }
    public function retrieve(Request $request,Response $response){
        if($request->hasParam('id')) {
            $id = $request->query('id');
            if($this->validation->validateNumber($id)) {
                $account = $_SERVER['ACCOUNT_REPO']->retrieve('id', $id)[0];
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
                $account = $_SERVER['ACCOUNT_REPO']->retrieve('id', $id)[0];
                $response->sendJSON($account);
                $body = $request->getBody();
                if(isset($body[PROP::PASSWORD])){
                    $values[PROP::PASSWORD] = $this->hashPassword($body[PROP::PASSWORD]);
                }
                $response->sendJSON($_SERVER['ACCOUNT_REPO']->update($id,$body));
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
                $response->sendJSON($_SERVER['ACCOUNT_REPO']->delete(PROP::USER_ID, $id));
            }else{
                $response->sendJSON('Invalid Account ID');
            }
        }else{
            $response->sendJSON('Account ID required to delete');
        }
    }


}