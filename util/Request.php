<?php
include_once './interface/IRequest.php';

class Request implements IRequest
{
    public $url;
    public $method;
    function __construct() {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->method = $this->getRequestMethod();
    }
    public function getParsedUrl(){
        return parse_url($this->url);
    }
    public function getPath(){
        $parsed = $this->getParsedUrl();
        return $parsed['path'];
    }
    public function query($param){
        $query = $this->getQuery();
        return $query[$param];
    }
    public function getQuery(){
        $query = array();
        parse_str($_SERVER['QUERY_STRING'],$query);
        return $query;
    }
    public function hasParam($param){
        $query = $this->getQuery();
        return isset($query[$param]);
    }
    public function getRequestMethod(){
        $method = 'GET';
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $body = array();
            parse_str(file_get_contents('php://input'), $body);
            if (isset($body['_method'])) {
                $method = $body['_method'];
            } else {
                $method = 'POST';
            }
        }
        return $method;
    }
    public function getBody() {
        if($this->method == 'POST'){
            return $_POST;
        }else if($this->method == 'PUT'){
            parse_str(file_get_contents('php://input'), $_PUT);
            unset($_PUT['_method']);
            return $_PUT;
        }else if($this->method == 'DELETE'){
            parse_str(file_get_contents('php://input'), $_DELETE);
            unset($_DELETE['_method']);
            return $_DELETE;
        }else{
            return $_GET;
        }
    }
    public function getJSONBody(){
        return json_encode($this->getBody());
    }
    public function getUser(){
        return $_SESSION['account'];
    }
    public function createSession($account){
        $date = $this->getCurrentDate();
        $expiration = $this->getCookieExpiration();
        $_SESSION['loggedIn'] = true;
        $_SESSION['account'] = $account;
        setcookie('loggedIn',$date,$expiration,"/");
    }
    public function validSession(){
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