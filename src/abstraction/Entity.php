<?php


namespace src\abstraction;

abstract class Entity{
    public $id;
    public $name;
    public function __construct($id,$name){
        $this->id = $id;
        $this->name = $name;
    }
}