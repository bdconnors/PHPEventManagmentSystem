<?php

namespace src\controller;

use src\abstraction\Controller;
use src\abstraction\Service;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\service\VenueService;

class VenueController extends Controller{

    public function __construct(ContainerInterface $container, VenueService $service){
        parent::__construct($container,$service);
    }

    public function retrieveAll(Request $request, Response $response, $args){

    }

    public function create(Request $request, Response $response, $args){

    }

    public function retrieve(Request $request, Response $response, $args){

    }

    public function update(Request $request, Response $response, $args){

    }

    public function delete(Request $request, Response $response, $args){

    }
}