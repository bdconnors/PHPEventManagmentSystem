<?php

require_once './interface/ITemplate.php';
class CreateVenueForm implements ITemplate{
    public $user;
    public function __construct($user = null){
        $this->user = $user;
    }

    public function __toString(){
        $form = new Head('Create Venue');
        $form .= new Navigation($this->user);
        $form .= "<div class='container mx-auto'>
                    <p style='color:red' id='err'></p>
                <form id='createVenueForm' method='POST' action='/venues/create' onsubmit='return validateCreateVenue()'>
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='name'>Venue Name:</label>         
                            <input class='form-control' type='text'  name='name' id='name'/>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='nameConfirm'>Confirm Venue Name:</label>  
                            <input type='text' class='form-control' name='nameConfirm' id='nameConfirm'/>
                        </div>
                    </div>     
  
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='numberallowed'>Capacity:</label>         
                            <input class='form-control' type='number' value='1' name='capacity' id='capacity'/>
                        </div>
                    </div>
                    <div class='form-group row'>
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