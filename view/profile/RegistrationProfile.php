<?php


class RegistrationProfile implements ITemplate
{
    public $user;
    public $registration;
    public function __construct($user,$registration){
        $this->user = $user;
        $this->registration = $registration;
    }

    public function __toString(){
        $head = new Head($this->registration->name);
        $navigation = new Navigation($this->user);
        $foot = new Foot(array('navbar'));
        $profile = $head;
        $profile .= $navigation;
        $profile .= "<div class='jumbotron jumbotron-fluid'>
            <div class='container'>
                <h1 class='display-4'>{$this->registration->name} Registration</h1>
                <p class='lead'><b>Session:</b> {$this->registration->session->name}</p>
                <p class='lead'><b>Attendee:</b> {$this->registration->attendee->name}</p>
                <p class='lead'><b>Paid:</b>";
        if($this->registration->paid == 0){
            $profile .= "<span style='color:green'><i class='fa fa-check'></i></span>";
        }else{
            $profile .= "<span style='color:red'><i class='fa fa-times'></i></span>";
        }
        $profile .="</p>
            </div>
        </div>";
        $profile .= $foot;
        return $profile;
    }
}