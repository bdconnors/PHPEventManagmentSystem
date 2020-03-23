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
                <form id='createEventForm' method='POST' action='/events/create' onsubmit='return validateCreateEvent()'>
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='name'>Event Name:</label>         
                            <input class='form-control' type='text'  name='name' id='name'/>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='nameConfirm'>Confirm Event Name:</label>  
                            <input type='text' class='form-control' name='nameConfirm' id='nameConfirm'/>
                        </div>
                    </div>     
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='datestart'>Start Date:</label>  
                            <input type='date' value={$defaultDate} class='form-control' name='datestart' id='datestart'/>
                        </div>
                    </div>       
                         <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='dateend'>End Date:</label>  
                            <input type='date' value={$defaultDate} class='form-control' name='dateend' id='dateend'/>
                        </div>
                    </div>  
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='numberallowed'>Number Allowed:</label>         
                            <input class='form-control' type='number' value='1' name='numberallowed' id='numberallowed'/>
                        </div>
                    </div>";
        $form .= "<div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='venue'>Venue:</label>         
                            <select class='form-control' name='venue'>";
        $form .="<option value='-1' selected>None</option>";
        foreach ($this->venues as $venue) {
            $form .= "<option value='{$venue->id}'>{$venue->name}</option>";
        }
        $form .="</select>";
        $form .="</div>
                    </div>";
        $form .= "<div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='manager'>Manager:</label>         
                            <select class='form-control' name='manager'>";
        $form .="<option value='-1' selected>None</option>";
        foreach ($this->managers as $manager) {
            $form .= "<option value='{$manager->id}'>{$manager->name}</option>";
        }
        $form .="</select>";
        $form .= "</div>
                    </div>";
        $form .="<div class='form-group row'>
                        <div class='col-md-6'>
                            <button class='btn btn-secondary' type='submit'>Submit</button>     
                            <button class='btn btn-secondary' type='reset'>Reset</button>
                        </div>
                     </div>
                </form>
                </div>";
        $form .= new Foot(array('navbar','validation','sanitization'));
        return $form;
    }

}