<?php


namespace src\service;

use src\abstraction\Entity;
use src\abstraction\Repository;
use src\abstraction\Service;
use src\model\User;
use src\constants\PROP;

class UserService extends Service{

    public function __construct(Repository $repo){
        parent::__construct($repo);
    }

    public function retrieveAll(){
        return $this->repo->retrieveAll();
    }

    public function create($values){
        $hash = hash(PROP::HASH_ALG, $values[PROP::PASSWORD]);
        $values[PROP::PASSWORD] = $hash;
        return $this->repo->create($values);
    }

    public function retrieve($id){
        return $this->repo->retrieve(PROP::USER_ID,$id);
    }

    public function update($values){
        // TODO: Implement update() method.
    }

    public function delete($id){
        return $this->repo->delete(PROP::USER_ID,$id);
    }

}