<?php

require_once './interface/ITemplate.php';
class CreateSessionForm implements ITemplate {
    public $user;
    public $event;
    public function __construct($user = null,$event){
        $this->user = $user;
        $this->event = $event;
    }
    public function __toString(){
        $defaultStartDate = $this->event->dateStart;
        $defaultEndDate = $this->event->dateEnd;
        $form = new Head("Create {$this->event->name} Session");
        $form .= new Navigation($this->user);
        $form .= "<div class='container mx-auto'>
                    <p style='color:red' id='err'></p>
                <form id='createSessionForm' method='POST'>
                    <input type='hidden' name='event' value='{$this->event->id}'/>
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='name'>Session Name:</label>         
                            <input class='form-control' type='text'  name='name' id='name'/>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='nameConfirm'>Confirm Session Name:</label>  
                            <input type='text' class='form-control' name='nameConfirm' id='nameConfirm'/>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='datestart'>Start Date:</label>  
                            <input type='date' value={$defaultStartDate} class='form-control' name='startdate' id='startdate'/>
                        </div>
                    </div>       
                         <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='dateend'>End Date:</label>  
                            <input type='date' value={$defaultEndDate} class='form-control' name='enddate' id='enddate'/>
                        </div>
                    </div>  
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='numberallowed'>Number Allowed:</label>         
                            <input class='form-control' type='number' value='1' name='numberallowed' id='numberallowed'/>
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