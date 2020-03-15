<?php

require_once './view/component/Item.php';
class Options extends Item {
    public $options;
    public function __construct($id,$label,$options = array()){
        parent::__construct($id,$label);
        $this->options = $options;
    }
    public function add($id,$label){
        array_push($this->options,new Item($id,$label));
    }
    public function html(){
        $html = "";
        if(count($this->options) > 0) {
            foreach ($this->options as $option) {
                $html .= $option->html();
            }
        }
        return $html;

    }
}