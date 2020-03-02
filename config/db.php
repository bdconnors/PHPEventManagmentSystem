<?php
require_once'./util/EventDatabase.php';
$_DB = [];
$_DB =  [
        'dsn' => 'mysql:host=localhost;dbname=bdc5435',
        'user' => 'root',
        'pass' => 'Rubix123',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ],
    ];
$_SERVER['DB_CONNECTION'] = new EventDatabase($_DB['dsn'],$_DB['user'],$_DB['pass'],$_DB['options']);

