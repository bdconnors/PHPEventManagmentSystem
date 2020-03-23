<?php

require_once './view/builder/NavigationBuilder.php';
require_once './view/component/NavItem.php';
class Navigation implements ITemplate {
    public $user;
    public function __construct($user = null){
        $this->user = $user;
    }

    public function __toString(){
        $nav = $this->buildNav($this->user);
        return $nav->__toString();
    }
    protected function buildNav($account){
        $builder = new NavigationBuilder();
        $nav = $this->makeDefaultNav($builder);
        if(!empty($account)) {
            $builder->buildAccountPanel($account);
            if($account->role->id == 1 || $account->role->id == 2) {
                $nav = $this->makeAdminNav($builder);
            }else if($account->role->id == 3){
                $nav = $this->makeManagerNav($builder);
            }else if($account->role->id == 4) {
                $nav = $this->makeAttendeeNav($builder);
            }
        }
        return $nav;
    }
    protected function makeDefaultNav(NavigationBuilder $builder){
        return $builder->produce();
    }
    protected function makeAttendeeNav(NavigationBuilder $builder){
        $pages = [
            new NavItem('Home','/'),
            new NavItem('Events','/events'),
            new NavItem('My Registrations','/registrations')
        ];
        $builder->buildNavItems($pages);
        //$builder->buildMenu('events','My Registrations',$this->user->events);
        return $builder->produce();
    }
    protected function makeManagerNav(NavigationBuilder $builder){
        $pages = [
            new NavItem('Home','/'),
            new NavItem('Events','/events'),
            new NavItem('My Registrations','/registrations')
        ];
        $builder->buildNavItems($pages);
        /**$events = $this->user->events;
        $managed = array();
        $registered = array();
        foreach($events as $event){
            if($event->manager == $this->user->id){
                array_push($managed,$event);
            }else{
                array_push($registered,$event);
            }
        }
        $builder->buildMenu('events','Managed Events',$managed);
        $builder->buildMenu('events','My Registrations',$registered);**/

        return $builder->produce();
    }
     protected function makeAdminNav(NavigationBuilder $builder){
         $pages = [
             new NavItem('Home','/'),
             new NavItem('Accounts','/accounts'),
             new NavItem('Events','/events'),
             new NavItem('Venues','/venues'),
             new NavItem('My Registrations','/registrations')
         ];
         $builder->buildNavItems($pages);
        /**$builder->buildTabbedMenu('accounts','Accounts',$this->getAccounts());
        $builder->buildMenu('events','Events',$this->getEvents());
        $builder->buildMenu('venues','Venues',$this->getVenues());
        $builder->buildMenu('events','My Registrations',$this->user->events);**/
        return $builder->produce();
    }
    /**protected function getEvents(){
        return $_SERVER['EVENT_REPO']->retrieveAll();

    }
    protected function getVenues(){
        return $_SERVER['VENUE_REPO']->retrieveAll();
    }
    protected function getAccounts(){
        $superAdmin = $_SERVER['ACCOUNT_REPO']->retrieve('role',1);
        $regAdmins = $_SERVER['ACCOUNT_REPO']->retrieve('role',2);
        $admins = array_merge($superAdmin,$regAdmins);
        $managers = $_SERVER['ACCOUNT_REPO']->retrieve('role',3);
        $attendees = $_SERVER['ACCOUNT_REPO']->retrieve('role',4);
        return array('Administrators'=>$admins,'Managers'=>$managers,'Attendees'=>$attendees);
    }**/
}