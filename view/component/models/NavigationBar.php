<?php

require_once './view/component/models/AccountPanel.php';
require_once './view/component/models/MenuPanel.php';
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
    public function html(){
        $html = "<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
  <div class='mx-auto order-0'>
        <a class='navbar-brand mx-auto' href='#'>Event Management System</a>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='.dual-collapse2'>
            <span class='navbar-toggler-icon'></span>
        </button>
    </div>";
        $html .= $this->menuPanel->html();
        $html .= $this->accountPanel->html();
        $html .= "</nav>";
        return $html;
    }
}