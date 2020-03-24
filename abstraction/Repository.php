<?php
require_once('./util/Database.php');
abstract class Repository{

    protected $db;

    public function __construct($db){
        $this->db = $db;
    }

    abstract public function retrieveAll();

    abstract public function retrieve($prop,$value);

    abstract public function create($values);

    abstract public function update($values);

    abstract public function delete($id);

    abstract public function build($values);

}
