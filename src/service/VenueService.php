<?php
namespace src\service;

use src\abstraction\Repository;
use src\abstraction\Service;

class VenueService extends Service {

    protected Repository $repo;

    public function __construct(Repository $repo){
        parent::__construct($repo);
    }

    public function retrieveAll()
    {
        // TODO: Implement retrieveAll() method.
    }

    public function retrieve($id)
    {
        // TODO: Implement retrieve() method.
    }

    public function create($values)
    {
        // TODO: Implement create() method.
    }

    public function update($values){
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

}