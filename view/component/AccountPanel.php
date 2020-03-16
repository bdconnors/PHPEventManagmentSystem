<?php
;
class AccountPanel {
    public Account $account;
    public function __construct(){}

    public function __toString(){
        $html ="";
        if(isset($this->account)){
            $html .= "<div class='navbar-collapse collapse w-100 order-3 dual-collapse2'>
                <ul class='navbar-nav ml-auto'>
                    <li class='nav-models dropdown'>
                        <button type='button' class='btn btn-secondary dropdown-toggle' data-toggle='dropdown'>
                            <i class='fa fa-user'></i> {$this->account->name}
                        </button>
                        <div class='dropdown-menu' aria-labelledby='accountPanel'>
                            <div class='dropdown-header'><b>Role:</b> {$this->account->role->name}</div>
                            <a class='dropdown-item' id='loginDropDown' href='#' onclick='logOut()'>
                                <i class='fa fa-power-off'></i> <b>Log Out</b>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>";
        }
        return $html;
    }
    public function setAccount($account){
        $this->account = $account;
    }

}