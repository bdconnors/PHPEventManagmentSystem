<?php


class MenuPanel{
    public $menus;
    public function __construct($menus = array()){
        $this->menus = $menus;
    }
    public function add($menu){
        array_push($this->menus,$menu);
    }
    public function html(){
        $html = "<div class='navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2'>
                        <ul class='navbar-nav mr-auto'>";
        foreach ($this->menus as $menu){
            $html .= $menu->html();
        }
        $html .="</ul></div>";
        return $html;
    }

}