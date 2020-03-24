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
            $list .= "<form method='GET' action='/events/create'>
                  <button type='submit' class='btn btn-secondary'>
                        <i class='fa fa-plus'></i> New Event
                  </button>
            </form>";
        }
        $list .="<h1>Events</h1>";
        foreach($this->events as $event){
            $isRegistered = $event->isRegistered($this->user->id);
            $list .= "<div class='card' style='width: 18rem;'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$event->name}</h5>
                        <h6 class='card-subtitle mb-2 text-muted'>Date: {$event->dateStart}</h6>";
            if($isRegistered){
                $list .= "<h6 class='card-subtitle mb-2' style='color:green'>
                                <i class='fa fa-check'></i> 
                                You are registered
                            </h6>";
            }else{
                $list .= "<form method='GET' action='/registrations/create'>
                                <input name='event' type='hidden' value='{$event->id}'/>
                                <input name='attendee' type='hidden' value='{$this->user->id}'/>
                                <button type='submit' class='btn btn-secondary'>Register</button>
                            </form>";
            }
            $list .= "<form method='GET' action='/sessions'>
                                <input name='event' type='hidden' value='{$event->id}'/>
                                <button type='submit' class='btn btn-secondary'>View Sessions</button>
                            </form>";
            $list .= "<div class='btn-group' role='group' aria-label='Event Actions'>";
            $list .= "<form method='GET' action='/events'>
                            <input name='id' type='hidden' value='{$event->id}'/>
                            <button type='submit' class='btn btn-secondary'>View</button>
                        </form>";
            if($this->user->role->id == 1 || $this->user->role->id == 2||$event->manager == $this->user->id){
                $list .= "<form id='eventDelete' method='POST' action='/events/delete'>
                            <input name='_method' type='hidden' value='DELETE' />
                            <input name='id' type='hidden' value='{$event->id}'/>
                            <button type='submit' class='btn btn-secondary'>Remove</button>
                         </form>
                         <form method='GET' action='/events/edit'>
                            <input name='id' type='hidden' value='{$event->id}'/>
                            <button type='submit' class='btn btn-secondary' class='card-link'>Edit</button>
                         </form>";
            }
  $list .= "</div>
        </div>
</div>";
        }
        $list .= new Foot(array('navbar'));
        return $list;
    }
}