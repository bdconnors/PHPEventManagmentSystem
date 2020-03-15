<?php


class Item {
    public $id;
    public $label;
    public function __construct($id,$label){
        $this->id = $id;
        $this->label = $label;
    }
    public function html(){
        return "<a class='dropdown-models' href='#' id='{$this->id}'>$this->label</a>";
    }
}