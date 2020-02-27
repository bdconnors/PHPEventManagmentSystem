<?php

namespace src\abstraction;

use src\abstraction\Entity;

abstract class Repository{

    protected PDODatabase $db;

    public function __construct(PDODatabase $db){
        $this->db = $db;
    }

    abstract public function retrieveAll();

    abstract public function retrieve($prop, $value);

    abstract public function create($values);

    abstract public function update($values);

    abstract public function delete($prop, $value);

    abstract public function build($data);

}
