<?php

class Sanitization{

    public function __construct() {}

    public function sanitize($value){
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlentities($value);
        $value = strip_tags($value);
        return $value;
    }
}