<?php



require_once('./abstraction/Gathering.php');
class Event extends Gathering {

    public $venue;
    public function __construct($id, $name, $dateStart, $dateEnd, $numberAllowed,$venue){
        parent::__construct($id, $name, $dateStart, $dateEnd, $numberAllowed);
        $this->venue = $venue;
    }

}