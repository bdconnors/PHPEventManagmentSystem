<?php

require_once('./interface/IResponse.php');
class Response implements IResponse {

    public function __construct(){}

    public function send($content){
        echo $content;
    }
    public function sendJSON($content){
        echo json_encode($content);
    }
    public function redirect($url){
        header("Location: ".$url);
    }
    public function sendFile($location){
        readfile($location);
    }
    public function render(ITemplate $template){
        echo $template;
    }


}