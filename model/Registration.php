<?php


class Registration extends Entity {
    public bool $paid;
    public $event;
    public $attendee;
    public $session;
    public function __construct($id,$name,$event,$attendee,$session,bool $paid){
        parent::__construct($id,$name);
        $this->event = $event;
        $this->attendee = $attendee;
        $this->session = $session;
        $this->paid = $paid;
    }
}