<?php

require_once('./abstraction/Entity.php');
class Account extends Entity {

    private $password;
    public Role $role;
    public array $registrations;

    public function __construct($id,$name,$password,Role $role,$registrations = array()){
        parent::__construct($id,$name);
        $this->password = $password;
        $this->role = $role;
        $this->registrations = $registrations;
    }
    public function getPassword(){
        return $this->password;
    }

}