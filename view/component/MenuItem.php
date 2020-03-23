<?php

class MenuItem {
    public $id;
    public $label;
    public $type;
    public function __construct($id,$label,$type){
        $this->id = $id;
        $this->label = $label;
        $this->type = $type;
    }
    public function __toString(){
        return "<a class='dropdown-item' href='/{$this->type}?id={$this->id}' id='{$this->id}'>$this->label</a>";
    }
}