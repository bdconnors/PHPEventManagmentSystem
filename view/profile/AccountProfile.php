<?php

require_once './interface/ITemplate.php';
class AccountProfile implements ITemplate {
    public $user;
    public Account $account;
    public $registrations;
    public function __construct($user,$account,$registrations){
        $this->user = $user;
        $this->account = $account;
        $this->registrations = $registrations;
    }

    public function __toString(){
        $head = new Head($this->account->name);
        $navigation = new Navigation($this->user);
        $foot = new Foot(array('navbar'));
        $profile = $head;
        $profile .= $navigation;
        $profile .= "<div class='jumbotron jumbotron-fluid'>
            <div class='container'>
                <h1 class='display-4'>{$this->account->name}</h1>
                <p class='lead'><b>Role:</b> {$this->account->role->name}</p>
            </div>";
        $profile .= "<div class='container'>
                        <h4>Registrations:</h4>";
        if(count($this->registrations) > 0) {
            $profile .=" <div class='card' style='width: 18rem;'>
                            <ul class='list-group list-group-flush'>";
            foreach ($this->registrations as $registration) {
                $profile .= "<li class='list-group-item'>{$registration->name}</li>";
            }
            $profile .= "</ul>
                    </div>";
        }else{
            $profile .= "<p class='lead'><b>None</b></p>";
        }
        $profile .= "</div>";
        $profile .= "</div>";
        $profile .= $foot;
        return $profile;
    }
}