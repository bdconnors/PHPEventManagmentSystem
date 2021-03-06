<?php
require_once './view/component/Options.php';
require_once './view/component/TabbedOptions.php';

class Menu  {

    public $id;
    public $label;
    public $options;
    public function __construct($id,$label,$options = array()) {
        $this->id = $id;
        $this->label = $label;
        $this->options = $options;
    }
    public function addOptionGroup($id,$label,$options,$default = 'None'){
        array_push($this->options,new TabbedOptions($id,$label,$options,$default));
    }
    public function addOptions($id,$label,$options,$default = 'None'){
        array_push($this->options,new Options($id,$label,$options,$default));
    }
    public function __toString(){
        $html = "<li class='nav-models dropdown'>
                    <a class='nav-link dropdown-toggle' href='#'
                    id='{$this->id}NavbarDropdown' role='button' data-toggle='dropdown'
                    aria-haspopup='true' aria-expanded='false'>
                        {$this->label}
                    </a> 
                    <div class='dropdown-menu' aria-labelledby='{$this->id}NavbarDropdown'>";
        foreach($this->options as $option){
            $html .= $option;
        }
        $html.="</div><li>";
        return $html;
    }

}