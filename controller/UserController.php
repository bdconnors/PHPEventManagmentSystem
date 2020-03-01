<?php
require_once('./service/UserService.php');
class UserController {
    static public function retrieveAll(Request $request,Response $response){
        $service = new UserService(new UserRepository($_SERVER['DB_CONNECTION']));
        $response->sendJSON($service->retrieveAll());
    }
    static public function retrieve(Request $request,Response $response){
        $response->sendJSON($request);
    }
}