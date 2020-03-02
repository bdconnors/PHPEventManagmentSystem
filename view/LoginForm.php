<?php

require_once'./interface/ITemplate.php';
class LoginForm implements ITemplate{

    static public function render($values = array()){
 $register = '"./register"';
        return "User Name: <input type='text' value='' name='name' id='name'/>
                Password: <input type='password' value='' name='password' id='password'/>
                <button>Login</button>
                <button onclick='window.location.href={$register}'>Register</button>";
    }

}