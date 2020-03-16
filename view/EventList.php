<?php

require_once './interface/ITemplate.php';
class EventList implements ITemplate {
    public $events;
    public $user;
    public function __construct($user,$events)
    {
        $this->events = $events;
        $this->user = $user;
    }

    public function __toString()
    {
        $list = new Head('Events');
        $list.= new Navigation($this->user);
        if($this->user->role->id == 1 || $this->user->role->id == 2){
            $list .= "<button type='button' class='btn btn-secondary'>
                            <i class='fa fa-plus'></i> New Event
                        </button>";
        }
        foreach($this->events as $event){
            $list .= "<div class='card' style='width: 18rem;'>
  <div class='card-body'>
    <h5 class='card-title'>{$event->name}</h5>
    <h6 class='card-subtitle mb-2 text-muted'>Date: {$event->dateStart}</h6>
    <a href='#' class='card-link'>Register</a>
    <a href='/events?id={$event->id}' class='card-link'>View</a>";
            if($this->user->role->id == 1 || $this->user->role->id == 2){
                $list .= "<a href='#' class='card-link'>Remove</a>
                          <a href='#' class='card-link'>Edit</a>";
            }
  $list .= "</div>
</div>";
        }
        $list .= new Foot(array('navbar'));
        return $list;
    }
}