<?php

class AdminService{
    private Validation $validation;
    public function __construct(Validation $validation){
        $this->validation = $validation;
    }
    public function createAccount(IRequest $request,IResponse $response){
        $body = $request->getBody();
        $password = $body[PROP::PASSWORD];
        $name = $body[PROP::NAME];
        $role = 3;
        if(isset($body[PROP::ROLE])){$role = $body[PROP::ROLE];}
        $validName = $this->validation->validateAlphaNumeric($name);
        $validPass = $this->validation->validateAlphaNumeric($password);
        $validRole =  $validName = $this->validation->validatePosInteger($role);
        if($validName && $validPass && $validRole) {
            $hash = $this->hashPassword($body[PROP::PASSWORD]);
            $values = array('name' => $name, 'password' => $hash, 'role' => $role);
            $_SERVER['ACCOUNT_REPO']->create($values);
            $response->redirect('/accounts');
        }else{
            $response->send(new CreateAccountForm('Invalid user name or password'));
        }
    }
    public function retrieveAccount(IRequest $request,IResponse $response){
        if($request->hasParam('id')) {
            $id = $request->query('id');
            if($this->validation->validatePosInteger($id)) {
                $account = $_SERVER['ACCOUNT_REPO']->retrieve('id', $id)[0];
                $response->sendJSON($account);
            }else{
                $response->sendJSON('Invalid Account ID');
            }
        }else{
            $response->sendJSON('Account ID required to retrieve ');
        }
    }
    public function updateAccount(IRequest $request,IResponse $response){
        if($request->hasParam('id')) {
            $id = $request->query('id');
            if($this->validation->validatePosInteger($id)) {
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
    public function deleteAccount(IRequest $request,IResponse $response){
        $id = $request->getBody()['id'];
        if($this->validation->validatePosInteger($id)) {
            $response->sendJSON($_SERVER['ACCOUNT_REPO']->delete($id));
            $response->redirect('/accounts');
        }else{
            $response->sendJSON('Invalid Account ID');
        }

    }
    public function createEvent(IRequest $request, IResponse $response){
        $body = $request->getBody();
        $name = $body['name'];
        $validName = $this->validation->validateAlphaNumericSpaces($name);
        $dateStart = $body['datestart'];
        $validDateStart = $this->validation->validateDate($dateStart);
        $dateEnd = $body['dateend'];
        $validDateEnd = $this->validation->validateDate($dateEnd);
        $manager = $body['manager'];
        $validManager = $this->validation->validateAnyInteger($manager);
        $venue = $body['venue'];
        $validVenue = $this->validation->validateAnyInteger($venue);
        $numberAllowed = $body['numberallowed'];
        $validNumberAllowed = $this->validation->validatePosInteger($numberAllowed);
        $valid = $validName && $validDateStart && $validDateEnd && $validManager && $validVenue && $validNumberAllowed;
        if($valid){
            $result = $_SERVER['EVENT_REPO']->create($body);
            $response->redirect('/events');
        }else{
            $response->sendJSON('Invalid Input');
        }
    }
    public function createVenue(IRequest $request,IResponse $response){
        $values = $request->getBody();
        $validName = $_SERVER['VALIDATION']->validateAlphaNumericSpaces($values['name']);
        $validCapacity = $_SERVER['VALIDATION']->validatePosInteger($values['capacity']);
        $valid = $validName && $validCapacity;
        if($valid) {
            $_SERVER['VENUE_REPO']->create($values);
            $response->redirect('/venues');
        }else{
            $response->send("Invalid Input");
        }
    }
    public function deleteEvent(IRequest $request,IResponse $response){
        $id = $request->getBody()['id'];
        if($this->validation->validatePosInteger($id)) {
            $response->sendJSON($_SERVER['EVENT_REPO']->delete($id));
            $response->redirect('/events');
        }else{
            $response->sendJSON('Invalid Event ID');
        }

    }
    public function deleteVenue(IRequest $request,IResponse $response){
        $id = $request->getBody()['id'];
        if($this->validation->validatePosInteger($id)) {
            $response->sendJSON($_SERVER['VENUE_REPO']->delete($id));
            $response->redirect('/venues');
        }else{
            $response->sendJSON('Invalid Event ID');
        }

    }
    public function hashPassword($plainText){
        return hash(PROP::HASH_ALG, $plainText);
    }
}