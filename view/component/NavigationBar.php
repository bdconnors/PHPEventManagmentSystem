<?php

require_once './view/component/AccountPanel.php';
require_once './view/component/MenuPanel.php';
require_once './interface/IComponent.php';
class NavigationBar implements IComponent {
    public AccountPanel $accountPanel;
    public MenuPanel $menuPanel;
    public function __construct(){
        $this->menuPanel = new MenuPanel();
        $this->accountPanel = new AccountPanel();
    }
    public function addMenu($menu){
        $this->menuPanel->add($menu);
    }
    public function setAccount($account){
        $this->accountPanel->setAccount($account);
    }
    public function html(){
        $html = "<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
        <a class='navbar-brand mx-auto' href='/dashboard'>Event Management System</a>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='.dual-collapse2'>
            <span class='navbar-toggler-icon'></span>
        </button>";
        $html .= $this->menuPanel->html();
        $html .= $this->accountPanel->html();
        $html .= "</nav>";
        return $html;
    }
}