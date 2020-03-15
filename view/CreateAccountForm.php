<?php

require_once './interface/ITemplate.php';
class CreateAccountForm implements ITemplate{

    static public function render($values = array('user'=>null)){
        $form = Head::render(array('title'=>'Register'));
        $form .= Navigation::render($values);
        $form.= "<p style='color:red' id='err'></p>
                <form id='registrationForm' method='post' onsubmit='return validateRegistration()'>
                    Account Type: <select id='role' name='role'>     
                        <option selected value='4'>Attendee</option>
                        <option value='3'>Event Manager</option>
                        <option value='2'>Admin</option>
                    </select>
                    Account Name: <input type='text'  name='name' id='name'/>
                    Confirm Account Name: <input type='text' name='nameConfirm' id='nameConfirm'/>
                    Password: <input type='password' name='password' id='password'/>
                    Confirm Password: <input type='password' name='passwordConfirm' id='passwordConfirm'/>
                    <input type='submit' value='Submit'/>
                    <input type='reset' value='Reset'/>
                </form>";
        $form.=Foot::render(array('scripts'=>array('navbar','validation','sanitization')));
        return $form;
    }

}