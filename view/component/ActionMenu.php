<?php

require_once './view/component/Action.php';
class ActionMenu {
    public $operations;
    public function __construct($operations = array()){
        $this->operations = $operations;
    }
    public function add($title,$description,$img,$href){
        array_push($this->operations,new Action($title,$description,$img,$href));
    }
    public function __toString(){
        $html = "<div class='row'>";
        foreach($this->operations as $operation){
            $html.= $operation;
        }
        $html .="</div>";
        return $html;
    }
}