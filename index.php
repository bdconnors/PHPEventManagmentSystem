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
require_once './controller/HomeController.php';
require_once './controller/AuthenticationController.php';
require_once './controller/EventController.php';
require_once './controller/VenueController.php';
require_once './controller/AccountController.php';
require_once './controller/RegistrationController.php';
require_once './repo/RoleRepository.php';
require_once './repo/VenueRepository.php';
require_once './repo/AccountRepository.php';
require_once './repo/EventRepository.php';
require_once './repo/SessionRepository.php';
require_once './repo/RegistrationRepository.php';
require_once './service/AuthenticationService.php';
require_once './service/AdminService.php';
require_once './service/TemplateService.php';
require_once './view/factory/ListFactory.php';
require_once './view/factory/ProfileFactory.php';

$validation = new Validation(new Sanitization());
$authorization = new Authorization();
$dbConn = new Database(DB::DSN,DB::USER,DB::PASSWORD,DB::OPTIONS);

$roleRepo = new RoleRepository($dbConn);
$venueRepo = new VenueRepository($dbConn);
$sessionRepo = new SessionRepository($dbConn);
$registrationRepo = new RegistrationRepository($dbConn,$sessionRepo);
$accountRepo = new AccountRepository($dbConn,$roleRepo,$registrationRepo);
$eventRepo = new EventRepository($dbConn,$venueRepo,$sessionRepo,$registrationRepo,$accountRepo);

$authenticationService = new AuthenticationService();
$adminService = new AdminService($validation);
$templateService = new TemplateService(new ListFactory(),new ProfileFactory());

$_SERVER['DB_CONN'] = $dbConn;
$_SERVER['VALIDATION'] = $validation;
$_SERVER['VENUE_REPO'] = $venueRepo;
$_SERVER['EVENT_REPO'] = $eventRepo;
$_SERVER['ROLE_REPO'] = $roleRepo;
$_SERVER['ACCOUNT_REPO'] = $accountRepo;
$_SERVER['REGISTRATION_REPO'] = $registrationRepo;
$_SERVER['AUTHENTICATION_SERVICE'] = $authenticationService;
$_SERVER['ADMIN_SERVICE'] = $adminService;
$_SERVER['TEMPLATE_SERVICE'] = $templateService;

session_start();

$router = new Router($authorization);
$_SERVER['ROUTER']= $router;

//GET
$router->get('/', 'HomeController', 'index',4);

$router->get('/login', 'AuthenticationController', 'index',5);

$router->get('/registrations', 'RegistrationController', 'index',4);

$router->get('/events', 'EventController', 'index',4);
$router->get('/events/create', 'EventController', 'createForm',3);

$router->get('/venues', 'VenueController', 'index',2);
$router->get('/venues/create', 'VenueController', 'createForm',2);

$router->get('/accounts', 'AccountController', 'index',2);
$router->get('/accounts/create', 'AccountController', 'createForm',2);

//POST
$router->post('/login', 'AuthenticationController', 'login',5);
$router->post('/events/create', 'EventController', 'create',3);
$router->post('/accounts/create', 'AccountController', 'create',2);
$router->post('/venues/create', 'VenueController', 'create',2);

//DELETE
$router->delete('/events/delete', 'EventController', 'delete',3);
$router->delete('/accounts/delete', 'AccountController', 'delete',2);
$router->delete('/venues/delete', 'VenueController', 'delete',2);


//Resolve Request
$router->resolve(new Request(),new Response());