<?php

require_once './view/component/ActionMenu.php';
class ActionMenuBuilder {
    public $menu;
    public function __construct(){
        $this->menu = new ActionMenu();
    }
    public function build($account){
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
        $this->menu->add('Accounts','View and manage attendee accounts','./img/attendeeCap.jpeg','/accounts');
        $this->menu->add('Venues','View and manage venues','./img/venueCap.jpeg','/venues');
        $this->menu->add('Registrations',"View your event registrations",'./img/eventCap.jpeg','/events');
        $this->menu->add('Events','View and manage events','./img/eventCap.jpeg','/events');

    }
    protected function buildManagerActions(){
        $this->menu->add('Registrations',"View your event registrations",'./img/eventCap.jpeg','/events');
        $this->menu->add('Events','View and manage assigned events','./img/eventCap.jpeg','/events');

    }
    protected function buildAttendeeActions(){
        $this->menu->add('Registrations',"View your event registrations",'./img/eventCap.jpeg','/events');
        $this->menu->add('Events','View all events','./img/eventCap.jpeg','/events');
    }
}