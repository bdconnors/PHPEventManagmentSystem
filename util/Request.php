<?php
include_once './interface/IRequest.php';

class Request implements IRequest
{
    public $url;
    public $method;
    function __construct() {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
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
    public function hasQuery(){
        $parsed = $this->getParsedUrl();
        return isset($parsed['query']);
    }
    public function hasParam($param){
        $query = $this->getQuery();
        return isset($query[$param]);
    }
    public function getBody() {
        return json_decode(file_get_contents('php://input'),true);
    }
}