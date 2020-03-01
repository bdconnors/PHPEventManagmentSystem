<?php
require_once './config/db.php';
require_once './util/Request.php';
require_once './util/Router.php';
require_once './repo/UserRepository.php';
require_once './service/UserService.php';
require_once './controller/UserController.php';

$_SERVER['DB_CONNECTION'] = new EventDatabase($_DB['dsn'],$_DB['user'],$_DB['pass'],$_DB['options']);
$router = new Router(new Request());
$router->get('/','UserController','retrieveAll');
$router->get('/user','UserController','retrieve');