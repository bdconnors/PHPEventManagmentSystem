<?php
require_once('./abstraction/Entity.php');
class Venue extends Entity {

    public $name;
    public $capacity;

    public function __construct($id,$name,$capacity){
        parent::__construct($id,$name);
        $this->capacity = $capacity;
    }

}