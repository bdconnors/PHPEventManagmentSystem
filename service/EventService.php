<?php
require_once('./abstraction/Service.php');
require_once('./abstraction/Repository.php');
class EventService extends Service{
    private Validation $validation;
    public function __construct(Repository $repo,Validation $validation){
        parent::__construct($repo);
        $this->validation = $validation;
    }

    public function retrieveAll(){
        return $this->repo->retrieveAll();
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