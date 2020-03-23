<?php

require_once './interface/ITemplate.php';
class AccountList implements ITemplate {
    public $user;
    public $accounts;
    public function __construct($user,$accounts){
        $this->user = $user;
        $this->accounts = $accounts;
    }

    public function __toString()
    {

        $list = new Head('Accounts');
        $list.= new Navigation($this->user);
        if($this->user->role->id == 1 || $this->user->role->id == 2){
            $addAcc="window.location.href='/accounts/create'";
            $list .= "<button type='button' class='btn btn-secondary' onclick={$addAcc}>
                            <i class='fa fa-plus'></i> New Account
                        </button>";
        }
        foreach($this->accounts as $account){
            $viewAcc="window.location.href='/accounts?id={$account->id}'";
            $list .= "<div class='card' style='width: 18rem;'>
  <div class='card-body'>
    <h5 class='card-title'>{$account->name}</h5>
    <h6 class='card-subtitle mb-2 text-muted'>{$account->role->name}</h6>
     <button class='btn btn-secondary' onclick=$viewAcc>View</button>";
            if($account->role->id != 1){
                $list .= "<form id='accDelete' method='POST' action='/accounts/delete'>
                            <input name='_method' type='hidden' value='DELETE' />
                            <input name='id' type='hidden' value='{$account->id}'/>
                            <button type='submit' class='btn btn-secondary'>Remove</button>
                         </form>
                <button class='btn btn-secondary' class='card-link'>Edit</button>";
            }

    $list .="</div>
</div>";
        }
        $list .= new Foot(array('navbar'));
        return $list;
    }
}