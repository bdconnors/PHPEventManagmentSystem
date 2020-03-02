<?php

require_once('./repo/UserRepository.php');
require_once('./service/LoginService.php');
class LoginController {
    static public function authenticate(Request $request,Response $response){
        $service = new LoginService(new UserRepository($_SERVER['DB_CONNECTION']));
        $body = $request->getBody();
        $name = $body['name'];
        $password = $body['password'];
        $response->sendJSON($service->authenticate($name,$password));
    }

}