<?php

require_once './interface/ITemplate.php';
class Head implements ITemplate {
    public $title;
    public function __construct($title){
        $this->title = $title;
    }

    public function __toString(){
        return "<html lang='en'>
                <head>
                    <title>{$this->title}</title>
                    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
                    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
                    <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
                    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
                </head>
                <body>";
    }
}