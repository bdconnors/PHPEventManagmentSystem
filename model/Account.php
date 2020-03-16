<?php

require_once('./abstraction/Entity.php');
class Account extends Entity {

    private $password;
    public $events;
    public Role $role;

    public function __construct($id,$name,$password,Role $role,$events = array()){
        parent::__construct($id,$name);
        $this->password = $password;
        $this->role = $role;
        $this->events = $events;
    }
    public function getPassword(){
        return $this->password;
    }

}