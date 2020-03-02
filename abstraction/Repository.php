<?php
require_once('./util/EventDatabase.php');
abstract class Repository{

    protected EventDatabase $db;

    public function __construct(EventDatabase $db){
        $this->db = $db;
    }

    abstract public function retrieveAll();

    abstract public function retrieve($prop,$alias,$value);

    abstract public function create($values);

    abstract public function update($id,$values);

    abstract public function delete($prop, $value);

    abstract public function build($data);

}
