<?php

use src\EventDatabase;
use src\repo\UserRepository;
use src\service\UserService;
use Psr\Container\ContainerInterface;
use Selective\Config\Configuration;
use Slim\App;
use Slim\Factory\AppFactory;

return [
    Configuration::class => function () {
        return new Configuration(require __DIR__ . '/settings.php');
    },
    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);
        $app = AppFactory::create();
        return $app;
    },
    PDO::class => function (ContainerInterface $container) {
        $config = $container->get(Configuration::class);

        $host = $config->getString('db.host');
        $dbname =  $config->getString('db.database');
        $username = $config->getString('db.username');
        $password = $config->getString('db.password');
        $flags = $config->getArray('db.flags');
        $dsn = "mysql:host=$host;dbname=$dbname;";

        return new PDO($dsn, $username, $password, $flags);
    },
    EventDatabase::class => function(ContainerInterface $container){
        $pdo = $container->get(PDO::class);
        return new EventDatabase($pdo);
    },
    UserRepository::class => function(ContainerInterface $container){
        $db = $container->get(EventDatabase::class);
        return new UserRepository($db);
    },
    UserService::class => function(ContainerInterface $container){
        $repo = $container->get(UserRepository::class);
        return new UserService($repo);
    }
];