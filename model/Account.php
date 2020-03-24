<?php

require_once('./abstraction/Entity.php');
class Account extends Entity {

    private $password;
    public $role;

    public function __construct($id,$name,$password,$role){
        parent::__construct($id,$name);
        $this->password = $password;
        $this->role = $role;
    }
    public function getPassword(){
        return $this->password;
    }

}