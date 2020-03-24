<?php

require_once './interface/ITemplate.php';
class CreateRegistrationForm implements ITemplate {
    public $user;
    public $account;
    public $event;
    public function __construct($user = null,$event,$account){
        $this->user = $user;
        $this->event = $event;
        $this->account = $account;
    }
    public function __toString(){
        $form = new Head("{$this->event->name} Registration");
        $form .= new Navigation($this->user);
        $form .= "<div class='container mx-auto'>
                    <p style='color:red' id='err'></p>
                <form id='createRegistrationForm' method='POST'>
                    <input type='hidden' name='attendee' value='{$this->account->id}'/>
                    <input type='hidden' name='event' value='{$this->event->id}'/>
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
                            <input type='checkbox' name='paid'/>
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