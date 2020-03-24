<?php

require_once './interface/ITemplate.php';
class CreateAccountForm implements ITemplate{

    public $user;
    public function __construct($user = null){
        $this->user = $user;
    }

    public function __toString(){
        $form = new Head('Create Account');
        $form .= new Navigation($this->user);
        $form .= "<div class='container mx-auto'>
                    <p style='color:red' id='err'></p>
                <form id='createAccountForm' method='POST' onsubmit='return validateAccountCreation()'>
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='role'>Account Type:</label>
                            <select class='form-control' id='role' name='role'>     
                                <option selected value='4'>Attendee</option>
                                <option value='3'>Event Manager</option>
                                <option value='2'>Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='name'>Account Name:</label>         
                            <input class='form-control' type='text'  name='name' id='name'/>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='nameConfirm'>Confirm Account Name:</label>  
                            <input type='text' class='form-control' name='nameConfirm' id='nameConfirm'/>
                        </div>
                    </div>
                    <div class='form-group row'> 
                        <div class='col-md-6'>    
                            <label for='password'>Password:</label>  
                            <input class='form-control' type='password' name='password' id='password'/>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <div class='col-md-6'>
                            <label for='passwordConfirm'>Confirm Password:</label>  
                            <input type='password' class='form-control' name='passwordConfirm' id='passwordConfirm'/>
                        </div>
                     </div>
                     <div class='form-group row'>
                        <div class='col-md-6'>
                            <button class='btn btn-secondary' type='submit'>Submit</button>     
                            <button class='btn btn-secondary' type='reset'>Reset</button>
                        </div>
                     </div>
                </form>
                </div>";
        $form .= new Foot(array('navbar','validation','sanitization','accountForms'));
        return $form;
    }

}