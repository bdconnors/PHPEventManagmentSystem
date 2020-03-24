<?php

require_once './interface/ITemplate.php';
class SessionList implements ITemplate {
    public $event;
    public $user;
    public function __construct($user,$event){
        $this->event = $event;
        $this->user = $user;
    }

    public function __toString()
    {
        $list = new Head("{$this->event->name} Sessions");
        $list.= new Navigation($this->user);
        $addSession="window.location.href='/sessions/create?event={$this->event->id}'";
        if($this->user->role->id == 1 || $this->user->role->id == 2 || $this->user->id == $this->event->manager->id){
            $list .= "<button type='button' class='btn btn-secondary' onclick=$addSession>
                            <i class='fa fa-plus'></i> New Session
                        </button>";
        }
        $list .="<h1>Sessions for {$this->event->name}</h1>";
        if(count($this->event->sessions) > 0) {
            foreach ($this->event->sessions as $session) {
                $list .= "<div class='card' style='width: 18rem;'>
                    <div class='card-body'>
                    <h5 class='card-title'>{$session->name}</h5>
                    <h6 class='card-subtitle mb-2 text-muted'>Date: {$session->dateStart}</h6>
                    <div class='btn-group' role='group' aria-label='Session Actions'>
                        <form method='GET' action='/sessions'>
                            <input name='id' type='hidden' value='{$session->id}'/>
                            <button class='btn btn-secondary' type='submit'>View</button>
                        </form>";
                if ($this->user->role->id == 1 || $this->user->role->id == 2 || $this->event->manager == $this->user->id) {
                    $list .= "<form id='sessionDelete' method='POST' action='/sessions/delete'>
                        <input name='_method' type='hidden' value='DELETE' />
                        <input name='id' type='hidden' value='{$session->id}'/>
                        <button type='submit' class='btn btn-secondary'>Remove</button>
                    </form>
                    <form method='GET' action='/sessions/edit'>
                        <input name='id' type='hidden' value='{$session->id}'/>
                        <button class='btn btn-secondary' type='submit'>Edit</button>
                    </form>";
                }
                $list .= "</div></div>";
            }
        }else{
            $list .="<h4>No Sessions Found</h4>";
        }
        $list .= new Foot(array('navbar'));
        return $list;
    }
}