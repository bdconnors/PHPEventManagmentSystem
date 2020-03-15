<?php
require_once('./abstraction/Entity.php');
class Venue extends Entity {

    public $name;
    public $capacity;
    public $events;

    public function __construct($id,$name,$capacity,$events = array()){
        parent::__construct($id,$name);
        $this->capacity = $capacity;
        $this->events = $events;
    }

}