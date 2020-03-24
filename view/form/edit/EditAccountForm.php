<?php

require_once './interface/ITemplate.php';
class EditAccountForm implements ITemplate{

    public $user;
    public $account;
    public function __construct($user = null,$account){
        $this->user = $user;
        $this->account = $account;
    }

    public function __toString(){
        $roleId = $this->account->role->id;
        $form = new Head('Edit Account');
        $form .= new Navigation($this->user);
        $form .= "<div class='container mx-auto'>
                    <p style='color:red' id='err'></p>
                <form id='editAccount' method='POST' onsubmit='return validateAccountUpdate()'>
                    <input name='_method' type='hidden' value='PUT' />
                    <input name='id' type='hidden' value='{$this->account->id}'/>
                    <div class='container'>
                        <h4>Account Role</h4>
                        <div class='form-inline'>
                            <select class='form-control mr-1'  id='role' name='role'>     
                                <option selected value='4'>Attendee</option>
                                <option value='3'>Event Manager</option>
                                <option value='2'>Admin</option>
                            </select>  
                        </div>
                    </div>
                    <br/>
                    <div class='container'>
                        <h4>Account Name:</h4>  
                        <div class='form-inline'>       
                            <input class='form-control mr-1' type='text' value='{$this->account->name}' 
                        </div>
                    </div>
                    <br/>
                    <div class='container'>
                        <h4>Password</h4>
                        <div class='form-inline'>    
                            <input class='form-control mr-1' value='dummyPassword' type='password' name='password' 
                            id='password' disabled/>
                            <button id='editPassBtn' name='edit' type='button' class='btn btn-secondary'>
                                Edit
                            </button>
                        </div> 
                    </div>
                    <div id='passwordConfirmContainer' class='container' style='display:none'>
                        <h4>Confirm Password:</h4> 
                        <div class='form-inline'>
                            <input type='password' class='form-control mr-1' name='passwordConfirm' 
                            id='passwordConfirm' disabled/>
                        </div>
                    </div>
                    <br/>
                    <div class='container'>
                        <div class='form-inline'>
                            <button type='submit' class='btn btn-secondary'>Submit</button> 
                            <button class='btn btn-secondary' type='reset'>Reset</button>
                        </div>
                    </div>
                </form>
                </div>";

        $form .= new Foot(array('navbar','validation','sanitization','accountForms'));
        $form .= "<script>
                    setupUpdateAccount('{$this->account}');
                </script>";
        return $form;
    }

}