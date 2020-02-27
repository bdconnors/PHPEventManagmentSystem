<?php


namespace src\controller;


use Psr\Container\ContainerInterface;
use src\abstraction\Controller;
use src\abstraction\Service;

class SessionController extends Controller {

    public function __construct(ContainerInterface $container, Service $service){
        parent::__construct($container, $service);
    }

}