<?php

require_once './view/component/Action.php';
class ActionMenu implements IComponent {
    public $operations;
    public function __construct($operations = array()){
        $this->operations = $operations;
    }
    public function add($title,$description,$img,$href){
        array_push($this->operations,new Action($title,$description,$img,$href));
    }
    public function html(){
        $html = "<div class='row'>";
        foreach($this->operations as $operation){
            $html.= $operation->html();
        }
        $html .="</div>";
        return $html;
    }
}