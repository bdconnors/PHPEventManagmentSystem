<?php

require_once('./abstraction/Repository.php');
class SessionRepository extends Repository {

    public function __construct(EventDatabase $db){
        parent::__construct($db);
    }

    public function retrieveAll(){
        // TODO: Implement retrieveAll() method.
    }

    public function retrieve($prop, $value){
        // TODO: Implement retrieve() method.
    }

    public function create($values){
        // TODO: Implement create() method.
    }

    public function update($values){
        // TODO: Implement update() method.
    }

    public function delete($prop, $value){
        // TODO: Implement delete() method.
    }

    public function build($data){
        // TODO: Implement build() method.
    }

}