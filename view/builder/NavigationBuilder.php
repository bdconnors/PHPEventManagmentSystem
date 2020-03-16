<?php

require_once './view/component/NavigationBar.php';
require_once './view/component/Item.php';
require_once './view/component/Menu.php';
class NavigationBuilder {
    public NavigationBar $nav;
    public function __construct(){
        $this->nav = new NavigationBar();
    }
    public function buildTabbedMenu($id,$label,$groups){
        $dropDown = new Menu($id,$label);
        foreach ($groups as $key=>$value){
            $items = $this->makeItemList($value,$id);
            $dropDown->addOptionGroup($id,$key,$items);
        }
        $this->nav->addMenu($dropDown);
    }
    public function buildMenu($id,$label,$entities)
    {
        $dropDown = new Menu($id, $label);
        $items = $this->makeItemList($entities,$id);
        $dropDown->addOptions($id, $label, $items);
        $this->nav->addMenu($dropDown);
    }
    public function buildAccountPanel($account){
        $this->nav->setAccount($account);
    }
    public function produce(){
        return $this->nav;
    }
    protected function makeItemList($entities,$type){
        $items = [];
        foreach($entities as $entity){
            array_push($items,new Item($entity->id,$entity->name,$type));
        }
        return $items;
    }

}