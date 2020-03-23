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
        $form .= "<div class='container mx-auto'>
                    <p style='color:red' id='err'>{$this->errMessage}</p>
                    <form id='loginForm' method='post' onsubmit='validateLogin()'>
                        <div class='form-group row'>
                            <div class='col-lg-3'>
                                <label for='name'>Account Name</label>
                                <input class='form-control' type='text' name='name' id='name'/>
                            </div>
                        </div>
                         <div class='form-group row'>
                            <div class='col-lg-3'>
                                <label for='name'>Password</label>
                                <input class='form-control' type='password' name='password' id='password'/>
                            </div>
                         </div>
                        <div class='form-group row'>
                            <div class='col-lg-3'>
                                <button type='submit' class='btn btn-secondary'/>Login</button>
                            </div>
                        </div>              
                    </form>
                  </div>";
        $form .= $foot;
        return $form;
    }

}