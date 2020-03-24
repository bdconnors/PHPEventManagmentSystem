<?php

require_once './interface/ITemplate.php';
class CreateEventForm implements ITemplate{

    public $user;
    public $venues;
    public $managers;
    public function __construct($user = null,$venues,$managers){
        $this->user = $user;
        $this->venues = $venues;
        $this->managers = $managers;
    }

    public function __toString(){
        $defaultDate = date("Y-m-j");
        $form = new Head('Create Event');
        $form .= new Navigation($this->user);
        $form .= "<div class='container mx-auto'>
                    <p style='color:red' id='err'></p>
                <form id='createEventForm' method='POST' action='/events/create' onsubmit='return validateAccountCreation()'>
                    <div class='container'>
                         <h4>Event Name</h4> 
                        <div class='form-inline'> 
                            <input class='form-control mr-1' type='text'  name='name' id='name'/>
                        </div>
                    </div>
                    <div class='container'>
                        <h4>Confirm Event Name</h4> 
                        <div class='form-inline'>
                            <input type='text' class='form-control mr-1' name='nameConfirm' id='nameConfirm'/>
                        </div>
                    </div>     
                    <div class='container'>
                        <h4>Start Date</h4> 
                        <div class='form-inline'>
                            <input type='date' value={$defaultDate} class='form-control mr-1' name='datestart' id='datestart'/>
                        </div>
                    </div>       
                    <div class='container'>
                        <h4>End Date</h4>  
                        <div class='form-inline'>
                          
                            <input type='date' value={$defaultDate} class='form-control mr-1' name='dateend' id='dateend'/>
                        </div>
                    </div>";

        $form.= "<div class='container'>
                        <h4>Number Allowed</h4> 
                        <div class='form-inline'>
                                
                            <input class='form-control mr-1' type='number' value='1' name='numberallowed' id='numberallowed'/>
                        </div>
                    </div>";
        $form .= "<div class='container'>
                        <h4>Manager</h4> 
                        <div class='form-inline'>
                                  
                            <select class='form-control mr-1' name='manager'>";
        $form .="<option value='-1' selected>None</option>";
        foreach ($this->managers as $manager) {
            $form .= "<option value='{$manager->id}'>{$manager->name}</option>";
        }
        $form .="</select>";
        $form .= "</div>
                    </div>";
        $form .= "<div class='container'>
                    <h4>Venue</h4>
                    <div class='form-inline'>";
        $form.="<select id='venueOptions' class='form-control mr-1' name='venue'>";
        $form .="<option value='-1' selected>None</option>";
        foreach ($this->venues as $venue) {
            $form .= "<option value='{$venue->id}'>{$venue->name}</option>";
        }
        $form .="</select>
            </div>
        </div>";
        $form .="<br/><div class='container'>
                        <div class='form-inline'>
                            <button class='btn btn-secondary' type='button'>Submit</button>     
                            <button class='btn btn-secondary' type='reset'>Reset</button>
                        </div>
                     </div>
                </form>
                </div>";
        $form .= new Foot(array('navbar','validation','sanitization','eventForms'));
        return $form;
    }

}