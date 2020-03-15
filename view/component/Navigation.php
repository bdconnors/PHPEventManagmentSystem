<?php

require_once './view/builder/NavigationBuilder.php';
class Navigation implements ITemplate {

    static public function render($values = array('user'=>null)){
        return Navigation::buildNav($values['user']);
    }
    static protected function buildNav($account){
        $builder = new NavigationBuilder();
        $nav = Navigation::buildAttendeeNav($builder);
        if(!empty($account)) {
            $builder->buildAccountPanel($account);
            if($account->role->id == 1) {
                $nav = Navigation::buildAdminNav($builder);
            }
        }
        return $nav->html();
    }
    static protected function buildAttendeeNav(NavigationBuilder $builder){
        return $builder->produce();
    }
    static protected function buildAdminNav(NavigationBuilder $builder){
        $builder->buildTabbedMenu('accounts','Accounts',Navigation::getAccounts());
        $builder->buildTabbedMenu('events','Events',Navigation::getEvents());
        $builder->buildMenu('venues','Venues',Navigation::getVenues());
        return $builder->produce();
    }
    static protected function getEvents(){
        $venues = $_SERVER['VENUE_REPO']->retrieveAll();
        $options = [];
        foreach($venues as $venue){
            $options[$venue->name] = $venue->events;
        }
        return $options;
    }
    static protected function getVenues(){
        return $_SERVER['VENUE_REPO']->retrieveAll();
    }
    static protected function getAccounts(){
        $admins = $_SERVER['ACCOUNT_REPO']->retrieve('role',1);
        $managers = $_SERVER['ACCOUNT_REPO']->retrieve('role',2);
        $attendees = $_SERVER['ACCOUNT_REPO']->retrieve('role',3);
        return array('Administrators'=>$admins,'Managers'=>$managers,'Attendees'=>$attendees);

    }
}