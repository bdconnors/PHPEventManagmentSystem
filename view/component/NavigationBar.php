<?php

require_once './view/component/AccountPanel.php';
require_once './view/component/MenuPanel.php';
class NavigationBar {
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
    public function __toString(){
        $html = "<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
        <a class='navbar-brand mx-auto' href='/'>Event Management System</a>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='.dual-collapse2'>
            <span class='navbar-toggler-icon'></span>
        </button>";
        $html .= $this->menuPanel;
        $html .= $this->accountPanel;
        $html .= "</nav>";
        return $html;
    }
}