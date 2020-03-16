<?php



require_once('./abstraction/Gathering.php');
class Event extends Gathering {
    public $venue;
    public $manager;
    public $registrations;
    public $sessions;
    public function __construct($id, $name, $dateStart, $dateEnd, $numberAllowed,$venue,$manager = -1,$registrations = array(),$sessions = array()){
        parent::__construct($id, $name, $dateStart, $dateEnd, $numberAllowed);
        $this->venue = $venue;
        $this->manager = $manager;
        $this->registrations = $registrations;
        $this->sessions = $sessions;
    }
}