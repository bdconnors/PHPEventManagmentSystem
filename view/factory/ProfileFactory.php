<?php

require_once './view/profile/EventProfile.php';
require_once './view/profile/VenueProfile.php';
require_once './view/profile/AccountProfile.php';
require_once './view/profile/SessionProfile.php';
require_once './view/profile/RegistrationProfile.php';
require_once './view/ErrorPage.php';

class ProfileFactory {

    public function __construct(){}

    public function make($type,$user,$item){
        $profile =  new ErrorPage('404 Page Not Found');
        switch($type){
            case 'EVENT':
                $profile = new EventProfile($user,$item);
                break;
            case 'VENUE':
                $profile = new VenueProfile($user,$item);
                break;
            case 'ACCOUNT':
                $profile = new AccountProfile($user,$item['account'],$item['registrations']);
                break;
            case 'SESSION':
                $profile = new SessionProfile($user,$item['session'],$item['registrations']);
                break;
            case 'REGISTRATION':
                $profile = new RegistrationProfile($user,$item);
                break;
            default:
                break;
        }
        return $profile;
    }

}