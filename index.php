<?php

require_once './config/db.php';
require_once './util/Database.php';
require_once './util/Route.php';
require_once './util/Router.php';
require_once './util/Request.php';
require_once './util/Response.php';
require_once './util/Authorization.php';
require_once './util/Validation.php';
require_once './util/Sanitization.php';
require_once './controller/DisplayController.php';
require_once './controller/AuthenticationController.php';
require_once './repo/RoleRepository.php';
require_once './repo/VenueRepository.php';
require_once './repo/AccountRepository.php';
require_once './repo/EventRepository.php';
require_once './service/AuthenticationService.php';
require_once './service/AdminService.php';
require_once './service/TemplateService.php';

$validation = new Validation(new Sanitization());
$authorization = new Authorization();
$dbConn = new Database(DB::DSN,DB::USER,DB::PASSWORD,DB::OPTIONS);

$roleRepo = new RoleRepository($dbConn);
$venueRepo = new VenueRepository($dbConn);
$eventRepo = new EventRepository($dbConn,$venueRepo);
$accountRepo = new AccountRepository($dbConn,$roleRepo,$eventRepo);

$authenticationService = new AuthenticationService($validation);
$adminService = new AdminService($validation);
$templateService = new TemplateService($validation);

$_SERVER['DB_CONN'] = $dbConn;
$_SERVER['VENUE_REPO'] = $venueRepo;
$_SERVER['EVENT_REPO'] = $eventRepo;
$_SERVER['ROLE_REPO'] = $roleRepo;
$_SERVER['ACCOUNT_REPO'] = $accountRepo;
$_SERVER['AUTHENTICATION_SERVICE'] = $authenticationService;
$_SERVER['ADMIN_SERVICE'] = $adminService;
$_SERVER['TEMPLATE_SERVICE'] = $templateService;

session_start();

$router = new Router($authorization);
$_SERVER['ROUTER']= $router;

//GET
$router->get('/login', 'DisplayController', 'login',5);
$router->get('/dashboard', 'DisplayController', 'dashboard',4);
$router->get('/events', 'DisplayController', 'eventsPage',4);
$router->get('/venues', 'DisplayController', 'venuesPage',2);
//TODO $router->get('/accounts', 'DisplayController', 'accountsPage',2);
//TODO $router->get('/accounts/create', 'DisplayController', 'createAccount',2);

//POST
$router->post('/login', 'AuthenticationController', 'login',5);
//TODO $router->post('/accounts/create', 'AuthenticationController', 'createAccount',2);

//Resolve Request
$router->resolve(new Request(),new Response());