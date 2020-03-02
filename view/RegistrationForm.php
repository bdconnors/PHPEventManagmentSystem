<?php

require_once'./interface/ITemplate.php';
class RegistrationForm implements ITemplate{

    static public function render($values = array()){
        return "User Name: <input type='text' value='User Name' name='name' id='name'/>
                Password: <input type='password' value='' name='password' id='password'/>
                Confirm Password: <input type='password' value='' name='passwordConfirm' id='passwordConfirm'/>
                <button>Submit</button>";
    }

}