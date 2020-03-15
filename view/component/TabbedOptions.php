<?php

require_once './view/component/Options.php';
class TabbedOptions extends Options {
    public $default;
    public function __construct($id, $label, $options,$defaultLabel){
        parent::__construct($id, $label, $options);
        $this->default = new Item("{$this->id}Default",$defaultLabel);
    }
    public function html(){
        $html = "<div class='dropdown-header'>{$this->label}</div>";
        if(count($this->options) > 0) {
            foreach ($this->options as $option) {
                $html .= $option->html();
            }
        }else{
            $html .= $this->default->html();
        }
        return $html;
    }
}