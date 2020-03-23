<?php

require_once './interface/ITemplate.php';
class RegistrationList implements ITemplate {
    public $user;
    public $registrations;
    public function __construct($user,$registrations){
        $this->user = $user;
        $this->registrations = $registrations;
    }

    public function __toString()
    {
        $list = new Head("{$this->user->name}'s Registrations");
        $list.= new Navigation($this->user);
        foreach($this->registrations as $registration){
            $list .= "<div class='card' style='width: 18rem;'>
  <div class='card-body'>
    <h5 class='card-title'>{$registration->name}</h5>
    <h6 class='card-subtitle mb-2 text-muted'>Date: {$registration->dateStart}</h6>
    <a href='/events?id={$registration->id}' class='card-link'>View</a>
       <a href='#' class='card-link'>Cancel</a>
       <a href='#' class='card-link'>Edit</a>
    </div>
</div>";
        }
        $list .= new Foot(array('navbar'));
        return $list;
    }
}