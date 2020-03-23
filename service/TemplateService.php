<?php

require_once './view/HomePage.php';
//list template
require_once './view/list/EventList.php';
require_once'./view/list/RegistrationList.php';
require_once'./view/list/AccountList.php';
require_once './view/list/VenueList.php';
//profile template
require_once './view/profile/EventProfile.php';
require_once './view/profile/VenueProfile.php';
//form template
require_once './view/LoginForm.php';
require_once './view/CreateAccountForm.php';
require_once './view/CreateEventForm.php';
require_once './view/CreateVenueForm.php';

class TemplateService {

    protected ListFactory $lists;
    protected ProfileFactory $profiles;
    public function __construct($lists,$profiles){
        $this->lists = $lists;
        $this->profiles = $profiles;
    }
    public function getHomePage($user){
        return new HomePage($user);
    }
    public function getError($msg = 'Internal Server Error'){
        return new ErrorPage($msg);
    }
    public function getLogin($err = ''){
        return new LoginForm($err);
    }
    public function getCreateAccount($user){
        return new CreateAccountForm($user);
    }
    public function getCreateVenue($user){
        return new CreateVenueForm($user);
    }
    public function getCreateEvent($user,$venues,$managers){
        return new CreateEventForm($user,$venues,$managers);
    }
    public function getProfile($type,$user,$item){
        return $this->profiles->make($type,$user,$item);
    }
    public function getList($type,$user,$items){
        return $this->lists->make($type,$user,$items);
    }

}