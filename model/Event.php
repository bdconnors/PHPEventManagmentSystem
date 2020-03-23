<?php



require_once('./abstraction/Gathering.php');
class Event extends Gathering {
    public $venue;
    public $manager;
    public $registrations;
    public $sessions;
    public function __construct(
        $id,
        $name,
        $dateStart,
        $dateEnd,
        $numberAllowed,
        $venue,
        $manager,
        $registrations = array(),
        $sessions = array()
    ){
        parent::__construct($id, $name, $dateStart, $dateEnd, $numberAllowed);
        $this->venue = $venue;
        $this->manager = $manager;
        $this->registrations = $registrations;
        $this->sessions = $sessions;
    }
    public function isRegistered($accountId){
        $registered = false;
        foreach($this->registrations as $registration){
            if($registration->attendee == $accountId){
                $registered = true;
            }
        }
        return $registered;
    }
    public function getRegistration($accountId){
        $selected = false;
        foreach($this->registrations as $registration){
            if($registration->attendee == $accountId){
                $selected = $registration;
            }
        }
        return $selected;
    }
    public function getSession($sessionId){
        $selected = false;
        foreach($this->sessions as $session){
            if($session->id == $sessionId){
                $selected = $session;
            }
        }
        return $selected;
    }
}