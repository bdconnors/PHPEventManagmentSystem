<?php

require_once './interface/ITemplate.php';
class EditVenueForm implements ITemplate{
    public $user;
    public $venue;
    public function __construct($user,$venue){
        $this->user = $user;
        $this->venue = $venue;
    }
    public function __toString(){
        $form = new Head('Edit Venue');
        $form .= new Navigation($this->user);
        $form .= "<div class='container mx-auto'>
                <p style='color:red' id='err'></p>
                <form id='editVenueForm' method='POST' onsubmit='return validateVenueUpdate()'>
                    <input name='_method' type='hidden' value='PUT'/>
                    <input name='id' type='hidden' value='{$this->venue->id}'/>
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='name'>Venue Name:</label>         
                            <input class='form-control' type='text'  value ='{$this->venue->name}' name='name' id='name'/>
                        </div>
                    </div> 
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='numberallowed'>Capacity:</label>         
                            <input class='form-control' type='number' value='{$this->venue->capacity}' name='capacity' id='capacity'/>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <button type='submit' class='btn btn-secondary'>Submit</button>
                            <button class='btn btn-secondary' type='reset'>Reset</button>
                        </div>
                     </div>
                </form>
                </div>";
        $form .= new Foot(array('navbar','validation','sanitization','venueForms'));
        return $form;
    }

}