<?php


class ErrorPage implements ITemplate{
    protected $errMsg;
    public function __construct($errMsg){
        $this->errMsg = $errMsg;
    }

    public function __toString()
    {
        return "<div><h1>{$this->errMsg}</h1></div>";
    }
}