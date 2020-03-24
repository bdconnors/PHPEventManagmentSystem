<?php

require_once './interface/ITemplate.php';
class EditRegistrationForm implements ITemplate {
    public $user;
    public $event;
    public $registration;
    public function __construct($user = null,$registration,$event){
        $this->user = $user;
        $this->registration = $registration;
        $this->event = $event;
    }
    public function __toString(){
        $form = new Head("Edit Registration");
        $form .= new Navigation($this->user);
        $form .= "<div class='container mx-auto'>
                    <p style='color:red' id='err'></p>
                <form id='editRegistrationForm' method='POST'>
                    <input type='hidden' name='_method' value='PUT'/>
                    <input type='hidden' name='id' value='{$this->registration->id}'/>
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='session'>Session:</label>
                            <select class='form-control' id='session' name='session'>";
        if(count($this->event->sessions) > 0) {
            foreach ($this->event->sessions as $session) {
                $form .= "<option value='$session->id'>{$session->name}</option>";
            }
        }else{
            $form .= "<option value='-1'>No Available Sessions</option>";
        }
        $form .="</select>
                        </div>
                     </div>
                     <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='session'>Paid:</label>
                            <input type='checkbox' id='paid' name='paid'/>
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
        $form .= new Foot(array('navbar','validation','sanitization','registrationForms'));
        $form .= "<script>
                    setupUpdateRegistration('{$this->registration}');
                </script>";
        return $form;
    }

}