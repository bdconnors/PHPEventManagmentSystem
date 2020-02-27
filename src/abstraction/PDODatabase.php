<?php

namespace src\abstraction;

use PDO;

abstract class PDODatabase
{
    protected PDO $conn;

    public function __construct(PDO $conn){
        $this->conn = $conn;
    }

    abstract public function retrieve($statement,$params);

    abstract public function create($statement,$params);

    abstract public function update($statement,$params);

    abstract public function delete($statement,$params);

}
