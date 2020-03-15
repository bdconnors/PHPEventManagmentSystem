<?php




require_once('./abstraction/Entity.php');
abstract class Gathering extends Entity {

    public $dateStart;
    public $dateEnd;
    public $numberAllowed;

    public function __construct($id, $name,$dateStart,$dateEnd,$numberAllowed){
        parent::__construct($id, $name);
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->numberAllowed = $numberAllowed;
    }

}