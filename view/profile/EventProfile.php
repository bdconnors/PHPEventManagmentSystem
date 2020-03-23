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
                    <p class='lead'><b>Manager:</b> {$this->event->manager->name}</p>
                    <p class='lead'><b>Number Allowed:</b> {$this->event->numberAllowed}</p>
                    <p class='lead'><b>Start Date:</b> {$this->event->dateStart}</p>
                    <p class='lead'><b>End Date:</b> {$this->event->dateEnd}</p>";
                    $profile .= "<form>";
                    if(!($this->event->isRegistered($this->user->id))) {
                        $profile .=" <p class='lead'><b>Registration:</b></p>
                        <input type='hidden' name='event' value='{$this->event->id}'/>
                        <b>Available Sessions:</b>
                        <br/>
                        <br/>
                        <select name='session'>";
                        foreach ($this->event->sessions as $session) {
                            $profile .= "<option value='{$session->id}'>{$session->name}</option>";
                        }
                        $profile .= "</select>
                        <br/>
                        <br/>
                        <input type='submit' value='Register'>";
                    }else{
                        $registration = $this->event->getRegistration($this->user->id);
                        $profile.="<input type='hidden' name='event' value='{$registration->id}'>
                                   <input type='hidden' name='attendee' value='{$registration->attendee}'>
                                   <p class='lead' style='color:green'><b>You are registered under session {$registration->session->name} for this event</b></p>
                                   <button type='submit' class='btn btn-secondary'>Cancel Registration</button>";
                    }
        $profile .= "</form></div>
        </div>";
        $profile .= $foot;
        return $profile;
    }
}