<?php

require_once './view/HomePage.php';

//form template
require_once './view/Login.php';
require_once './view/form/create/CreateAccountForm.php';
require_once './view/form/create/CreateEventForm.php';
require_once './view/form/create/CreateVenueForm.php';
require_once './view/form/create/CreateSessionForm.php';
require_once './view/form/create/CreateRegistrationForm.php';
require_once './view/form/edit/EditVenueForm.php';
require_once './view/form/edit/EditAccountForm.php';
require_once './view/form/edit/EditSessionForm.php';
require_once './view/form/edit/EditRegistrationForm.php';

class TemplateService {

    protected $lists;
    protected $profiles;
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
        return new Login($err);
    }
    public function getEditVenue($user,$venue){
        return new EditVenueForm($user,$venue);
    }
    public function getEditAccount($user,$account){
        return new EditAccountForm($user,$account);
    }
    public function getEditSession($user,$session){
        return new EditSessionForm($user,$session);
    }
    public function getEditRegistration($user,$registration,$event){
        return new EditRegistrationForm($user,$registration,$event);
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
    public function getCreateRegistration($user,$event,$account){
        return new CreateRegistrationForm($user,$event,$account);
    }
    public function getCreateSession($user,$event){
        return new CreateSessionForm($user,$event);
    }
    public function getProfile($type,$user,$item){
        return $this->profiles->make($type,$user,$item);
    }
    public function getList($type,$user,$items){
        return $this->lists->make($type,$user,$items);
    }

}