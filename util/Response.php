<?php

require_once('./interface/IResponse.php');
class Response implements IResponse {
    public function __construct(){
        $this->content = "";
    }
    public function send($content){
        echo $content;
    }
    public function sendJSON($content){
        echo json_encode($content);
    }


}