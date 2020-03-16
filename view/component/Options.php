<?php

require_once './view/component/Item.php';
class Options extends Item {
    public $options;
    public function __construct($id,$label,$options = array(),$defaultLabel){
        parent::__construct($id,$label,$id);
        $this->options = $options;
        $this->default = new Item("{$this->id}Default",$defaultLabel,$this->id);
    }
    public function add($id,$label){
        array_push($this->options,new Item($id,$label,$this->id));
    }
    public function __toString(){
        $html = "";
        if(count($this->options) > 0) {
            foreach ($this->options as $option) {
                $html .= $option;
            }
        }else{
            $html.=$this->default;
        }
        return $html;

    }
}