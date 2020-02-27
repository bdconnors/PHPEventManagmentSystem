<?php

use src\controller\UserController;
use Slim\App;

return function (App $app) {
    //user routes
    $app->get('/api/users', UserController::class .':retrieveAll');
    $app->post('/api/users', UserController::class .':create');
    $app->get('/api/users/{id}', UserController::class .':retrieve');
    $app->put('/api/users/{id}', UserController::class .':update');
    $app->delete('/api/users/{id}', UserController::class .':delete');

};