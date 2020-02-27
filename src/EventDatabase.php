<?php

namespace src;

use src\abstraction\PDODatabase;
use PDO;

class EventDatabase extends PDODatabase{

    public function __construct(PDO $conn){
        parent::__construct($conn);
    }

    public function retrieve($statement,$params)
    {   $results = [];
        $stmt = $this->conn->prepare($statement);
        $stmt->execute($params);
        while ($data = $stmt->fetch()) {
            array_push($results, $data);
        }
        return $results;
    }

    public function create($statement,$params){
        $stmt = $this->conn->prepare($statement);
        $stmt->execute($params);
        return $this->conn->lastInsertId();
    }

    public function update($statement,$params){
        $stmt = $this->conn->prepare($statement);
        $stmt->execute($params);
        return $stmt->rowCount();
    }

    public function delete($statement,$params){
        $stmt = $this->conn->prepare($statement);
        $stmt->execute($params);
        return $stmt->rowCount();
    }
}