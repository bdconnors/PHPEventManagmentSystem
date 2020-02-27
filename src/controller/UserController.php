<?php

namespace src\controller;
use src\constants\PROP;
use src\abstraction\Controller;
use src\abstraction\Service;
use src\service\UserService;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController extends Controller{

    public function __construct(ContainerInterface $container,UserService $service){
        parent::__construct($container,$service);
    }
    public function retrieveAll(Request $request, Response $response, $args){
        return $response->withJSON($this->service->retrieveAll());
    }
    public function create(Request $request, Response $response, $args){
        $lastInsertId = $this->service->create($request->getParsedBody());
        return $response->withJSON($lastInsertId);
    }
    public function retrieve(Request $request, Response $response, $args){
        $id = $request->getAttribute(PROP::ID);
        $user = $this->service->retrieve($id);
        return $response->withJSON($user);
    }
    public function update(Request $request, Response $response, $args){

    }
    public function delete(Request $request, Response $response, $args){
        $id = $request->getAttribute(PROP::ID);
        $affectedRows = $this->service->delete($id);
        return $response->withJSON($affectedRows);
    }

}