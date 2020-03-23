<?php


class NavItem {
    public $text;
    public $href;
    public function __construct($text,$href){
        $this->text = $text;
        $this->href = $href;
    }
    public function __toString(){
        return "  <li class='nav-item'>
        <a class='nav-link' href='{$this->href}'>{$this->text}</a>
      </li>";
    }

}