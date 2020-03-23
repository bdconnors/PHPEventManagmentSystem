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
        $addEvent="window.location.href='/events/create'";
        if($this->user->role->id == 1 || $this->user->role->id == 2){
            $list .= "<button type='button' class='btn btn-secondary' onclick=$addEvent>
                            <i class='fa fa-plus'></i> New Event
                        </button>";
        }
        foreach($this->events as $event){
            $viewEvent="window.location.href='/events?id={$event->id}'";
            $list .= "<div class='card' style='width: 18rem;'>
  <div class='card-body'>
    <h5 class='card-title'>{$event->name}</h5>
    <h6 class='card-subtitle mb-2 text-muted'>Date: {$event->dateStart}</h6>
    <button class='btn btn-secondary' onclick=$viewEvent>View</button>";
            if($this->user->role->id == 1 || $this->user->role->id == 2||$event->manager == $this->user->id){
                $list .= "<form id='eventDelete' method='POST' action='/events/delete'>
                            <input name='_method' type='hidden' value='DELETE' />
                            <input name='id' type='hidden' value='{$event->id}'/>
                            <button type='submit' class='btn btn-secondary'>Remove</button>
                         </form>
                         <button class='btn btn-secondary' class='card-link'>Edit</button>";
            }
  $list .= "</div>
</div>";
        }
        $list .= new Foot(array('navbar'));
        return $list;
    }
}