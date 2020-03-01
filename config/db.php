<?php
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

