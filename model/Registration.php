<?php


class Registration extends Entity {
    public bool $paid;
    public $attendee;
    public function __construct($id,$name,$attendee,bool $paid){
        parent::__construct($id,$name);
        $this->attendee = $attendee;
        $this->paid = $paid;
    }
}