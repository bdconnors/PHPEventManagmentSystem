<?php
require_once './config/db.php';
require_once './util/Request.php';
require_once './util/Router.php';
require_once './controller/HomeController.php';
require_once './controller/LoginController.php';
require_once './controller/UserController.php';
$_SERVER['ROUTER'] = new Router(new Request());
//POST routes
$_SERVER['ROUTER'] ->post('/user','UserController','create');
$_SERVER['ROUTER'] ->post('/login','LoginController','authenticate');
//GET routes
$_SERVER['ROUTER'] ->get('/','HomeController','displayLogin');
$_SERVER['ROUTER'] ->get('/register','HomeController','displayRegistration');
$_SERVER['ROUTER'] ->get('/user','UserController','retrieve');
//PUT routes
$_SERVER['ROUTER'] ->put('/user','UserController','update');
//DELETE routes
$_SERVER['ROUTER'] ->delete('/user','UserController','delete');
