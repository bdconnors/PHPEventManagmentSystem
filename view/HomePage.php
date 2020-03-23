<?php
require_once './interface/ITemplate.php';
require_once './view/include/Head.php';
require_once './view/include/Foot.php';
require_once './view/include/Navigation.php';
require_once './view/builder/ActionMenuBuilder.php';
class HomePage implements ITemplate {
    public $user;
    public function __construct($user = null){
        $this->user = $user;
    }

    public function __toString() {

        $builder = new ActionMenuBuilder();
        $builder->build($this->user);
        $menu = $builder->produce();

        $dashboard = new Head("HomePage");
        $dashboard .= new Navigation($this->user);
        $dashboard .= new Foot(array('navbar'));
        $dashboard .= $menu;
        return $dashboard;
    }
}