<?php

error_reporting(0);
ini_set('display_errors', '0');
date_default_timezone_set('US/Eastern');
$settings = [];
$settings['root'] = dirname(__DIR__);
$settings['public'] = $settings['root'] . '/public';
$settings['error_handler_middleware'] = [
    'display_error_details' => true,
    'log_errors' => true,
    'log_error_details' => true,
];
$settings['db'] =  [
    'driver' => 'mysql',
    'host' => 'localhost',
    'username' => 'root',
    'database' => 'bdc5435',
    'password' => 'Rubix123',
    'flags' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ],
];

return $settings;