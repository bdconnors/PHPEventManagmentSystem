<?php
abstract class DB{
    const DSN = 'mysql:host=localhost;dbname=bdc5435';
    const USER = 'root';
    const PASSWORD = 'Rubix123';
    const OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
}


