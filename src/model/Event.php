<?php


namespace src\model;


use src\abstraction\Gathering;
use src\abstraction\Entity;

class Event extends Gathering {

    public Venue $venue;

    public function __construct($id, $name, $dateStart, $dateEnd, $allowed,Venue $venue){
        parent::__construct($id, $name, $dateStart, $dateEnd, $allowed);
        $this->venue = $venue;
    }

}