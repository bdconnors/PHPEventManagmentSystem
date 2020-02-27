<?php

use src\abstraction\Entity;
use src\abstraction\Repository;
use src\abstraction\Service;

class EventService extends Service{

    public function __construct(Repository $repo){
        parent::__construct($repo);
    }

    public function retrieveAll(){
        // TODO: Implement retrieveAll() method.
    }

    public function retrieve($id){
        // TODO: Implement retrieve() method.
    }

    public function create($values){
        // TODO: Implement create() method.
    }

    public function update($values){
        // TODO: Implement update() method.
    }

    public function delete($id){
        // TODO: Implement delete() method.
    }

}