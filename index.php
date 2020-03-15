<?php
require_once './config/db.php';
require_once './util/Database.php';
require_once './util/Router.php';
require_once './util/Request.php';
require_once './util/Response.php';
require_once './controller/DisplayController.php';
require_once './controller/AccountController.php';
require_once './repo/RoleRepository.php';
require_once './repo/VenueRepository.php';
require_once './repo/EventRepository.php';
require_once './service/EventService.php';
$validation = new Validation(new Sanitization());
$dbConn = new Database(DB::DSN,DB::USER,DB::PASSWORD,DB::OPTIONS);
$roleRepo = new RoleRepository($dbConn);
$accountRepo = new AccountRepository($dbConn,$roleRepo);
$eventRepo = new EventRepository($dbConn);
$venueRepo = new VenueRepository($dbConn,$eventRepo);
$accountService = new AccountService($accountRepo,$validation);
$eventService = new EventService($eventRepo,$validation);

$_SERVER['DB_CONN'] = $dbConn;
$_SERVER['EVENT_REPO'] = $eventRepo;
$_SERVER['ROLE_REPO'] = $roleRepo;
$_SERVER['VENUE_REPO'] = $venueRepo;
$_SERVER['ACCOUNT_REPO'] = $accountRepo;
$_SERVER['ACCOUNT_SERVICE'] = $accountService;
$_SERVER['EVENT_SERVICE'] = $eventService;

session_start();

$router = new Router();
$_SERVER['ROUTER']= $router;

//GET
$router->get('/login', 'DisplayController', 'login');
$router->get('/dashboard', 'DisplayController', 'dashboard');
$router->get('/accounts', 'DisplayController', 'accountManagement');
$router->get('/accounts/create', 'DisplayController', 'createAccount');

//POST
$router->post('/login', 'AccountController', 'login');
$router->post('/accounts/create', 'AccountController', 'createAccount');

//API
$router->get('/api/user', 'AccountController', 'retrieveAccount');
$router->put('/api/user', 'AccountController', 'updateAccount');
$router->delete('/api/user', 'AccountController', 'deleteAccount');
//Resolve Request
$router->resolve(new Request(),new Response());