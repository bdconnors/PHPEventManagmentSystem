<?php

require_once './interface/IComponent.php';
class Item implements IComponent {
    public $id;
    public $label;
    public function __construct($id,$label){
        $this->id = $id;
        $this->label = $label;
    }
    public function html(){
        return "<a class='dropdown-item' href='#' id='{$this->id}'>$this->label</a>";
    }
}