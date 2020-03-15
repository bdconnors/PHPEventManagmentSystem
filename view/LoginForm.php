<?php

require_once './interface/ITemplate.php';
require_once './view/component/Head.php';
require_once './view/component/Foot.php';
class LoginForm implements ITemplate{
    static public function render($values = array('err'=>'')){
        $register = '"./register"';
        $form = Head::render(array('title'=>'Login'));
        $form .= Navigation::render();
        $form .= "<p style='color:red' id='err'>{$values['err']}</p>
                <form id='loginForm' method='post' onsubmit='validateLogin()'>
                    Account Name: <input type='text' name='name' id='name'/>
                    Password: <input type='password' name='password' id='password'/>
                    <br/>
                    <input type='submit' value='Login'/>              
                </form>    
                <button onclick='window.location.href={$register}'>Register</button>";
        $form .= Foot::render(array('scripts'=>array('validation','sanitization')));
        return $form;
    }

}