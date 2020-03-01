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
    public function getBody() {
        return $this->method;
    }
}