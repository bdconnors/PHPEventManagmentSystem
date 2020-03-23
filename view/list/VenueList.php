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
        $addVenue = "window.location.href='/venues/create'";
        $list .= "<button type='button' class='btn btn-secondary' onclick={$addVenue}>
                            <i class='fa fa-plus'></i> New Venue
                        </button>";
        foreach($this->venues as $venue){
            $viewVenue="window.location.href='/events?id={$venue->id}'";
            $list .= "<div class='card' style='width: 18rem;'>
  <div class='card-body'>
    <h5 class='card-title'>{$venue->name}</h5>
      <h6 class='card-subtitle mb-2 text-muted'>Capacity: {$venue->capacity}</h6>
    <button class='btn btn-secondary' onclick=$viewVenue>View</button>
    <form id='venueDelete' method='POST' action='/venues/delete'>
        <input name='_method' type='hidden' value='DELETE' />
        <input name='id' type='hidden' value='{$venue->id}'/>
        <button type='submit' class='btn btn-secondary'>Remove</button>
    </form>
    <button class='btn btn-secondary' class='card-link'>Edit</button>
    </div>
</div>";
        }
        $list .= new Foot(array('navbar'));
        return $list;
    }
}