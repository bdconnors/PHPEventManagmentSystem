<?php

require_once './view/list/EventList.php';
require_once './view/list/RegistrationList.php';
require_once './view/list/AccountList.php';
require_once './view/list/VenueList.php';
require_once './view/ErrorPage.php';

class ListFactory {

    public function __construct(){}

    public function make($type,$user,$items){
        $list = new ErrorPage('404 Page Not Found');
        switch($type){
            case 'EVENT':
                $list = new EventList($user,$items);
                break;
            case 'ACCOUNT':
                $list = new AccountList($user,$items);
                break;
            case 'VENUE':
                $list = new VenueList($user,$items);
                break;
            case 'REGISTRATION':
                $list = new RegistrationList($user,$items);
                break;
            default:
                break;
        }
        return $list;
    }
}