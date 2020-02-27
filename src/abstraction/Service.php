<?php

namespace src\abstraction;

use src\abstraction\Repository;

abstract class Service{

    protected Repository $repo;

    public function __construct(Repository $repo){
        $this->repo = $repo;
    }

    abstract public function retrieveAll();

    abstract public function retrieve($id);

    abstract public function create($values);

    abstract public function update($values);

    abstract public function delete($id);

}
