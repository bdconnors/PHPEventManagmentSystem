<?php

require_once './view/component/ActionMenu.php';
class ActionMenuBuilder {
    public $menu;
    public function __construct(){
        $this->menu = new ActionMenu();
    }
    public function build($values){
        $account = $values['user'];
        $role = $account->role->id;
        if($role == 1 || $role == 2){
            $this->buildAdminActions();
        }else if($role == 3){
            $this->buildManagerActions();
        }else{
            $this->buildAttendeeActions();
        }
    }
    public function produce(){
        return $this->menu;
    }
    protected function buildAdminActions(){
        $this->menu->add('Account Management','Manage attendees','./img/attendeeCap.jpeg','./accounts/create');
        $this->menu->add('Event Management','Manage events','./img/eventCap.jpeg','#');
        $this->menu->add('Venue Management','Manage venues','./img/venueCap.jpeg','#');
        $this->menu->add('Session Management','Manage event sessions','./img/venueCap.jpeg','#');
        $this->menu->add('Registrations',"View your registrations",'./img/eventCap.jpeg','#');
        $this->menu->add('Events','View all events','./img/eventCap.jpeg','#');

    }
    protected function buildManagerActions(){
        $this->menu->add('Event Management','Manage events assigned to you','./img/eventCap.jpeg','#');
        $this->menu->add('Attendee Management','Manage the attendees of events assigned to you','./img/attendeeCap.jpeg','#');
        $this->menu->add('Session Management','Manage the sessions of events assigned to you','./img/venueCap.jpeg','#');
        $this->menu->add('Registrations',"View your registrations",'./img/eventCap.jpeg','#');
        $this->menu->add('Events','View all events','./img/eventCap.jpeg','#');

    }
    protected function buildAttendeeActions(){
        $this->menu->add('Registrations',"View your registrations",'./img/eventCap.jpeg','#');
        $this->menu->add('Events','View all events','./img/eventCap.jpeg','#');
    }
}