<?php

require_once './interface/ITemplate.php';
class EditSessionForm implements ITemplate {
    public $user;
    public $session;
    public function __construct($user = null,$session){
        $this->user = $user;
        $this->session = $session;
    }
    public function __toString(){
        $form = new Head("Edit Session");
        $form .= new Navigation($this->user);
        $form .= "<div class='container mx-auto'>
                    <p style='color:red' id='err'></p>
                <form id='editSessionForm' method='POST'>
                    <input type='hidden' name='_method' value='PUT'/>
                    <input type='hidden' name='id' value='{$this->session->id}'/>
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='name'>Session Name:</label>         
                            <input class='form-control' type='text' value='{$this->session->name}' 
                            name='name' id='name'/>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='datestart'>Start Date:</label>  
                            <input type='date' value='{$this->session->dateStart}' class='form-control' 
                            name='startdate' id='startdate'/>
                        </div>
                    </div>       
                         <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='dateend'>End Date:</label>  
                            <input type='date' value='{$this->session->dateEnd}' class='form-control' 
                            name='enddate' id='enddate'/>
                        </div>
                    </div>  
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='numberallowed'>Number Allowed:</label>         
                            <input class='form-control' type='number' value='{$this->session->numberAllowed}' 
                            name='numberallowed' id='numberallowed'/>
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
        $form .= new Foot(array('navbar','validation','sanitization','sessionForms'));
        $form .= "<script>
                    setupUpdateSession('{$this->session}');
                </script>";
        return $form;
    }

}