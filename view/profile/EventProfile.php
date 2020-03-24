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
        //begin jumbo
        $profile .= "<div class='jumbotron jumbotron-fluid'>
                        <div class='container'>
                            <h1>{$this->event->name}</h1>
                            <p class='lead'><b>Venue:</b> {$this->event->venue->name}</p>
                            <p class='lead'><b>Manager:</b> {$this->event->manager->name}</p>
                            <p class='lead'><b>Number Allowed:</b> {$this->event->numberAllowed}</p>
                            <p class='lead'><b>Start Date:</b> {$this->event->dateStart}</p>
                            <p class='lead'><b>End Date:</b> {$this->event->dateEnd}</p>
                        </div>";
        $registered = $this->event->isRegistered($this->user->id);
        if($registered){
            $profile.="<div class='container'>
                    <p class='lead' style='color:green'><b>You are registered for this event</b></p>
                </div>";
        }
        $profile .= "<div class='container'>";
        $profile .= "<div class='btn-group' role='group' aria-label='Registration Actions'>";
        if(!$registered){
            $profile .= " <form method='GET' action='/registrations/create'>
                                <input name='event' type='hidden' value='{$this->event->id}'/>
                                <input name='attendee' type='hidden' value='{$this->user->id}'/>
                                <button class='btn btn-secondary' type='submit'>Register</button>
                            </form>";
        }
        $profile .= "<form method='GET' action='/sessions'>
                    <input name='event' type='hidden' value='{$this->event->id}'/>
                    <button class='btn btn-secondary' type='submit'>View Sessions</button>
                </form>
                <form method='GET' action='/registrations'>
                    <input name='event' type='hidden' value='{$this->event->id}'/>
                    <button class='btn btn-secondary' type='submit'>View Attendees</button>
                </form>
            </div>
        </div>";
        //end jumbo
        $profile .= "</div>";


        $profile .= $foot;
        return $profile;
    }
}