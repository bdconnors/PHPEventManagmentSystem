<?php
require_once './interface/ITemplate.php';
require_once './view/component/Head.php';
require_once './view/component/Foot.php';
require_once './view/Navigation.php';
class Dashboard implements ITemplate {
    static public function render($values = array()) {
        $dashboard = Head::render(array('title'=>'Dashboard'));
        $dashboard .= Navigation::render($values);
        $dashboard .= Foot::render(array('scripts'=>array('navbar')));
        return $dashboard;
    }
}