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
        $list = new Head('Venues');
        $list.= new Navigation($this->user);
        $list .= "<form method='GET' action='/venues/create'>
                  <button type='submit' class='btn btn-secondary'>
                        <i class='fa fa-plus'></i> New Venue
                  </button>
            </form>";
        $list .="<h1>Venues</h1>";
        foreach($this->venues as $venue){
            $list .= "<div class='card' style='width: 18rem;'>
                <div class='card-body'>
                    <h5 class='card-title'>{$venue->name}</h5>
                    <h6 class='card-subtitle mb-2 text-muted'>Capacity: {$venue->capacity}</h6>
                   <div class='btn-group' role='group' aria-label='Session Actions'>
                        <form method='GET' action='/venues'>
                            <input name='id' type='hidden' value='{$venue->id}'/>
                            <button type='submit' class='btn btn-secondary'>View</button>
                        </form>
                        <form id='venueDelete' method='POST' action='/venues/delete'>
                            <input name='_method' type='hidden' value='DELETE' />
                            <input name='id' type='hidden' value='{$venue->id}'/>
                            <button type='submit' class='btn btn-secondary'>Remove</button>
                        </form>
                        <form method='GET' action='/venues/edit'>
                            <input name='id' type='hidden' value='{$venue->id}'/>
                            <button class='btn btn-secondary' class='card-link' type='submit'>Edit</button>
                        </form>
                </div>
            </div>";
        }
        $list .= new Foot(array('navbar'));
        return $list;
    }
}