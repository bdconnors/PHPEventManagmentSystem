<?php
require_once('./repo/UserRepository.php');
require_once('./service/UserService.php');
class UserController {
    static public function retrieve(Request $request,Response $response){
        $service = new UserService(new UserRepository($_SERVER['DB_CONNECTION']));
        if($request->hasQuery()){
            $id = $request->query('id');
            $response->sendJSON($service->retrieve($id));
        }else{
            $response->sendJSON($service->retrieveAll());
        }

    }
    static public function create(Request $request,Response $response){
        $service = new UserService(new UserRepository($_SERVER['DB_CONNECTION']));
        $response->sendJSON($service->create($request->getBody()));
    }
    static public function delete(Request $request,Response $response){
        $service = new UserService(new UserRepository($_SERVER['DB_CONNECTION']));
        if($request->hasQuery() && $request->hasParam('id')){
            $id = $request->query('id');
            $response->sendJSON($service->delete($id));
        }else{
            $response->sendJSON('ID required to delete');
        }
    }
    static public function update(Request $request,Response $response){
        $service = new UserService(new UserRepository($_SERVER['DB_CONNECTION']));
        if($request->hasQuery() && $request->hasParam('id')){
            $id = $request->query('id');
            $response->sendJSON($service->update($id,$request->getBody()));
        }else{
            $response->sendJSON('ID required to update');
        }
    }

}