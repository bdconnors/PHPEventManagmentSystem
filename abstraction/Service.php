<?php
abstract class Service{

    protected Repository $repo;

    public function __construct(Repository $repo){
        $this->repo = $repo;
    }
}
