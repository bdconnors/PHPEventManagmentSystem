<?php


class SessionManager
{
    public function __construct(){}

    public function beginSession($user){
        $date = $this->getCurrentDate();
        $expiration = $this->getCookieExpiration();
        $_SESSION['loggedIn'] = true;
        $_SESSION['user'] = $user;
        setcookie('loggedIn',$date,$expiration,"/");
    }
    function hasValidSession(){
        $valid = false;
        if(!empty($_SESSION['loggedIn'])){
            $valid = $_SESSION['loggedIn'];
        }
        return $valid;
    }
    public function destroySession(){
        session_unset();
        if(isset($_COOKIE['loggedIn'])){setcookie('loggedIn',"",1,"/");}
        session_destroy();
    }
    public function getCookieExpiration(){
        return time() + 600;
    }
    public function getCurrentDate(){
        date_default_timezone_set('US/Eastern');
        return date("F j, Y, g:i a");
    }
}