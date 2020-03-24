<?php

require_once './interface/ITemplate.php';
class RegistrationList implements ITemplate {
    public $user;
    public $registrations;
    public $personal;
    public function __construct($user,$registrations){
        $this->user = $user;
        $this->registrations = $registrations;
        $this->personal = true;
    }
    public function setPersonal($personal){
        $this->personal = $personal;
    }
    public function __toString(){
        $list = new Head("Registrations");
        $list.= new Navigation($this->user);
        if($this->personal) {
            $list .= "<form method='GET' action='/events'>
                    <button class='btn btn-secondary' type='submit'>
                        <i class='fa fa-plus'></i> Browse Events
                    </button>
                 </form>";
            $list .="<h1>My Registrations</h1>";
        }else{
            $list .="<h1>Registrations</h1>";
        }
        if(count($this->registrations) > 0) {
            foreach ($this->registrations as $registration) {
                $list .= "<div class='card' style='width: 18rem;'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$registration->name} Registration</h5>
                        <h6 class='card-subtitle mb-2 text-muted'>Attendee: {$registration->attendee->name}</h6>
                        <div class='btn-group' role='group' aria-label='Registration Actions'>
                            <form method='GET' action='/registrations'>
                                <input name='id' type='hidden' value='{$registration->id}'/>
                                <button class='btn btn-secondary' type='submit'>View</button>
                            </form>
                            <form method='DELETE' action='/registrations/delete'>
                                <input name='_method' type='hidden' value='DELETE' />
                                <input name='id' type='hidden' value='{$registration->id}'/>
                                <button class='btn btn-secondary' type='submit'>Remove</button>
                            </form>
                            <form method='GET' action='/registrations/edit'>
                                <input name='id' type='hidden' value='{$registration->id}'/>
                                <button class='btn btn-secondary' type='submit'>Edit</button>
                            </form>
                        </div>
                </div>";
            }
        }else{
            $list .="<h4>No Registrations Found</h4>";
        }
        $list .= new Foot(array('navbar'));
        return $list;
    }
}