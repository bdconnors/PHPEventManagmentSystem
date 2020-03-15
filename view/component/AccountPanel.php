<?php
require_once './interface/IComponent.php';
class AccountPanel implements IComponent {
    public Account $account;
    public function __construct(){}
    public function setAccount($account){
        $this->account = $account;
    }
    public function signedIn(){
        return isset($this->account);
    }
    public function html(){
        $html ="<div class='navbar-collapse collapse w-100 order-3 dual-collapse2'>
            <ul class='navbar-nav ml-auto'>";
        if($this->signedIn()){
            $html.= $this->getAccountItems();
        }else{
         $html .= $this->getDefaultItems();
        }
        $html .="</ul></div>";
        return $html;
    }
    protected function getAccountItems(){
        return "<li class='nav-models dropdown'>
            <button type='button' class='btn btn-secondary dropdown-toggle' data-toggle='dropdown'>
                <i class='fa fa-user'></i> {$this->account->name}
            </button>
            <div class='dropdown-menu' aria-labelledby='accountPanel'>
                <div class='dropdown-header'>Role: {$this->account->role->name}</div>
                <a class='dropdown-item' id='loginDropDown' href='#' onclick='logOut()'><i class='fa fa-power-off'></i> <b>Log Out</b></a>
            </div>
         </li>";
    }
    protected function getDefaultItems(){
        return "<li class='nav-models'>
                <a class='nav-link' href='./login'>Login</a>
            </li>
        </ul>";
    }
}