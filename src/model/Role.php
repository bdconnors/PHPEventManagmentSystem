<?php


namespace src\model;

use src\abstraction\Entity;

class Role extends Entity {

    public function  __construct($id, $name){
        parent::__construct($id, $name);
    }

}