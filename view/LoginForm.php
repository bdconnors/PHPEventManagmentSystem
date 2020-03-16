<?php

require_once './interface/ITemplate.php';
require_once './view/include/Head.php';
require_once './view/include/Foot.php';
require_once './view/include/Navigation.php';
class LoginForm implements ITemplate{
    public $errMessage;
    public function __construct($errMessage = ''){
        $this->errMessage = $errMessage;
    }

    public function __toString(){
        $head = new Head('Login');
        $foot = new Foot(array('validation','sanitization'));
        $form = $head;
        $form .= new Navigation();
        $form .= "<p style='color:red' id='err'>{$this->errMessage}</p>
                <form id='loginForm' method='post' onsubmit='validateLogin()'>
                    Account Name: <input type='text' name='name' id='name'/>
                    Password: <input type='password' name='password' id='password'/>
                    <br/>
                    <input type='submit' value='Login'/>              
                </form>";
        $form .= $foot;
        return $form;
    }

}