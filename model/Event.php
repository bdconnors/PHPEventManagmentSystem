<?php



require_once('./abstraction/Gathering.php');
class Event extends Gathering {

    public Venue $venue;

    public function __construct($id, $name, $dateStart, $dateEnd, $allowed,Venue $venue){
        parent::__construct($id, $name, $dateStart, $dateEnd, $allowed);
        $this->venue = $venue;
    }

}