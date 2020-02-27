<?php


namespace src\abstraction;


abstract class Gathering extends Entity {

    public $dateStart;
    public $dateEnd;
    public $allowed;

    public function __construct($id, $name,$dateStart,$dateEnd,$allowed){
        parent::__construct($id, $name);
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->allowed = $allowed;
    }

}