<?php

require_once('./abstraction/Entity.php');
class Role extends Entity {

    public function  __construct($id, $name){
        parent::__construct($id, $name);
    }

}