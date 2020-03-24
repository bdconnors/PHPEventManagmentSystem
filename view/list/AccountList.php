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
        $list .="<h1>Accounts</h1>";
        foreach($this->accounts as $account){
            $viewAcc="window.location.href='/accounts?id={$account->id}'";
            $editAcc="window.location.href='/accounts/edit?id={$account->id}'";
            $list .= "<div class='card' style='width: 18rem;'>
  <div class='card-body'>
    <h5 class='card-title'>{$account->name}</h5>
    <h6 class='card-subtitle mb-2 text-muted'>{$account->role->name}</h6>
    <div class='btn-group' role='group' aria-label='Account Actions'>
        <form method='GET' action='/accounts'>
            <input name='id' type='hidden' value='{$account->id}'/>
            <button type='submit' class='btn btn-secondary'>View</button>
        </form>";
            if($account->role->id != 1 && $account->id != $this->user->id){
                $list .= "<form id='accDelete' method='POST' action='/accounts/delete'>
                    <input name='_method' type='hidden' value='DELETE' />
                    <input name='id' type='hidden' value='{$account->id}'/>
                    <button type='submit' class='btn btn-secondary'>Remove</button>
                </form>
                <form method='GET' action='/accounts/edit'>
                    <input name='id' type='hidden' value='{$account->id}'/>
                    <button class='btn btn-secondary' type='submit'>Edit</button>
                </form>";
            }

    $list .="</div>
</div>";
        }
        $list .= new Foot(array('navbar'));
        return $list;
    }
}