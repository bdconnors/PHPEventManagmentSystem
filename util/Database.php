<?php
class Database extends PDO {
    public function __construct($dsn,$user,$pass,$options){
        parent::__construct($dsn,$user,$pass,$options);
    }

    public function retrieve($statement,$params)
    {   $results = [];
        $stmt = $this->prepare($statement);
        $stmt->execute($params);
        while ($data = $stmt->fetch()) {
            array_push($results, $data);
        }
        return $results;
    }

    public function create($statement,$params){
        var_dump($params);
        $stmt = $this->prepare($statement);
        $stmt->execute($params);
        return $this->lastInsertId();
    }

    public function update($statement,$params){
        $stmt = $this->prepare($statement);
        $stmt->execute($params);
        return $stmt->rowCount();
    }

    public function delete($statement,$params){
        $stmt = $this->prepare($statement);
        $stmt->execute($params);
        return $stmt->rowCount();
    }
}