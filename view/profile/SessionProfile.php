<?php

require_once './interface/ITemplate.php';
class SessionProfile implements ITemplate {
    public $user;
    public $session;
    public $registrations;
    public function __construct($user,$session,$registrations){
        $this->user = $user;
        $this->session = $session;
        $this->registrations = $registrations;
    }

    public function __toString(){
        $head = new Head("{$this->session->name}");
        $navigation = new Navigation($this->user);
        $foot = new Foot(array('navbar'));
        $profile = $head;
        $profile .= $navigation;
        $profile .= "<div class='jumbotron jumbotron-fluid'>
            <div class='container'>
                <h1 class='display-4'>{$this->session->name}</h1>
                <p class='lead'><b>Start Date:</b> {$this->session->dateStart}</p>
                <p class='lead'><b>End Date:</b> {$this->session->dateEnd}</p>
                <p class='lead'><b>Number Allowed:</b> {$this->session->numberAllowed}</p>
            </div>";
        $profile .= "<div class='container'>
                        <h4>Registrations:</h4>";
        if(count($this->registrations) > 0) {
            $profile .=" <div class='card' style='width: 18rem;'>
                            <ul class='list-group list-group-flush'>";
            foreach ($this->registrations as $registration) {
                $profile .= "<li class='list-group-item'>{$registration->attendee->name}</li>";
            }
            $profile .= "</ul>
                    </div>";
        }else{
            $profile .= "<p class='lead'><b>None</b></p>";
        }
        $profile .= "</div>";
        $profile .= "</div>";
        $profile .= $foot;
        return $profile;
    }
}