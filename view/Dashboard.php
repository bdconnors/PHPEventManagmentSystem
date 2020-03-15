<?php
require_once './interface/ITemplate.php';
require_once './view/include/Head.php';
require_once './view/include/Foot.php';
require_once './view/section/Navigation.php';
require_once './view/builder/ActionMenuBuilder.php';
class Dashboard implements ITemplate {
    static public function render($values) {
        $builder = new ActionMenuBuilder();
        $builder->build($values);
        $menu = $builder->produce();
        $dashboard = Head::render(array('title'=>'Dashboard'));
        $dashboard .= Navigation::render($values);
        $dashboard .= Foot::render(array('scripts'=>array('navbar')));
        $dashboard .= $menu->html();
        return $dashboard;
    }
}