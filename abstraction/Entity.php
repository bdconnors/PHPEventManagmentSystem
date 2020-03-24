<?php




abstract class Entity{
    public $id;
    public $name;
    public function __construct($id,$name){
        $this->id = $id;
        $this->name = $name;
    }
    public function __toString()
    {
        return json_encode($this);
    }
}