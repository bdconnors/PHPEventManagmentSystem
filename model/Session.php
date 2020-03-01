<?php
require_once('./abstraction/Gathering.php');
class Session extends Gathering {

    public Event $event;

    public function __construct($id, $name, $dateStart, $dateEnd, $allowed,$event){
        parent::__construct($id, $name, $dateStart, $dateEnd, $allowed);
        $this->event = $event;
    }

}