<?php

require_once './view/component/Options.php';
class TabbedOptions extends Options {
    public $default;
    public function __construct($id, $label, $options,$defaultLabel){
        parent::__construct($id, $label, $options,$defaultLabel);
        $this->default = new MenuItem("{$this->id}Default",$defaultLabel,$this->id);
    }
    public function __toString(){
        $html = "<div class='dropdown-header'>{$this->label}</div>";
        if(count($this->options) > 0) {
            foreach ($this->options as $option) {
                $html .= $option;
            }
        }else{
            $html .= $this->default;
        }
        return $html;
    }
}