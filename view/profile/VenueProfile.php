<?php

require_once './interface/ITemplate.php';
class VenueProfile implements ITemplate {
    public $user;
    public Venue $venue;
    public function __construct($user,$venue){
        $this->user = $user;
        $this->venue = $venue;
    }

    public function __toString(){
        $head = new Head($this->venue->name);
        $navigation = new Navigation($this->user);
        $foot = new Foot(array('navbar'));
        $profile = $head;
        $profile .= $navigation;
        $profile .= "<div class='jumbotron jumbotron-fluid'>
            <div class='container'>
                <h1 class='display-4'>{$this->venue->name}</h1>
                    <p class='lead'><b>Capacity:</b> {$this->venue->capacity}</p>
            </div>
        </div>";
        $profile .= $foot;
        return $profile;
    }
}