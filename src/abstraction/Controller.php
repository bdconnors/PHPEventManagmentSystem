<?php

namespace src\abstraction;

use Psr\Container\ContainerInterface;
use src\abstraction\Service;

abstract class Controller{

    protected ContainerInterface $container;
    protected Service $service;

    public function __construct(ContainerInterface $container, Service $service){
        $this->container = $container;
        $this->service = $service;
    }

}