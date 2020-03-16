<?php

require_once './interface/ITemplate.php';
class EventProfile implements ITemplate {
    public $user;
    public Event $event;
    public function __construct($user,$event){
        $this->user = $user;
        $this->event = $event;
    }

    public function __toString(){
        $head = new Head($this->event->name);
        $navigation = new Navigation($this->user);
        $foot = new Foot(array('navbar'));
        $profile = $head;
        $profile .= $navigation;
        $profile .= "<div class='jumbotron jumbotron-fluid'>
            <div class='container'>
                <h1 class='display-4'>{$this->event->name}</h1>
                    <p class='lead'><b>Venue:</b> {$this->event->venue->name}</p>
                    <p class='lead'><b>Number Allowed:</b> {$this->event->numberAllowed}</p>
                    <p class='lead'><b>Start Date:</b> {$this->event->dateStart}</p>
                    <p class='lead'><b>End Date:</b> {$this->event->dateEnd}</p>
                    <p class='lead'><b>Sessions:</b></p>";

        foreach($this->event->sessions as $session){
            $profile .= "<p class='lead'>{$session->name}</p>";
        }
        $profile .= "</div>
        </div>";
        $profile .= $foot;
        return $profile;
    }
}