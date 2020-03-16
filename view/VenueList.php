<?php

require_once './interface/ITemplate.php';
class VenueList implements ITemplate {
    public $venues;
    public $user;
    public function __construct($user,$venues)
    {
        $this->venues = $venues;
        $this->user = $user;
    }

    public function __toString(){
        $list = new Head('Events');
        $list.= new Navigation($this->user);
        $list .= "<button type='button' class='btn btn-secondary'>
                            <i class='fa fa-plus'></i> New Venue
                        </button>";
        foreach($this->venues as $venue){
            $list .= "<div class='card' style='width: 18rem;'>
  <div class='card-body'>
    <h5 class='card-title'>{$venue->name}</h5>
      <h6 class='card-subtitle mb-2 text-muted'>Capacity: {$venue->capacity}</h6>
    <a href='/events?id={$venue->id}' class='card-link'>View</a>
    <a href='#' class='card-link'>Remove</a>
    <a href='#' class='card-link'>Edit</a>
    </div>
</div>";
        }
        $list .= new Foot(array('navbar'));
        return $list;
    }
}