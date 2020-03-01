<?php

require_once('./interface/IResponse.php');
class Response implements IResponse {
    public $content;
    public function __construct(){
        $this->content = "";
    }
    public function send($content){
        echo $this->content;
    }
    public function writeBody($content){
        $this->content.=$content;
    }
    public function sendBody(){
        echo $this->content;
    }
    public function sendJSON($content){
        echo json_encode($content);
    }


}