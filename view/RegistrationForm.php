<?php

require_once './interface/ITemplate.php';
class RegistrationForm implements ITemplate{

    static public function render($values = array('err'=>'')){
        $form = Head::render(array('title'=>'Register'));
        $form .= Navigation::render();
        $form.= "<p style='color:red' id='err'>{$values['err']}</p>
                <form id='registrationForm' method='post' onsubmit='return validateRegistration()'>
                    Account Name: <input type='text'  name='name' id='name'/>
                    Confirm Account Name: <input type='text' name='nameConfirm' id='nameConfirm'/>
                    Password: <input type='password' name='password' id='password'/>
                    Confirm Password: <input type='password' name='passwordConfirm' id='passwordConfirm'/>
                    <input type='submit' value='Submit'/>
                    <input type='reset' value='Reset'/>
                </form>";
        $form.=Foot::render(array('scripts'=>array('validation','sanitization')));
        return $form;

    }

}