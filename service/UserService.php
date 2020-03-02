<?php

require_once('./abstraction/Service.php');
require_once('./abstraction/Repository.php');
require_once('./constants/PROP.php');
class UserService extends Service{

    public function __construct(Repository $repo){
        parent::__construct($repo);
    }

    public function retrieveAll(){
        return $this->repo->retrieveAll();
    }

    public function create($values){
        $values[PROP::PASSWORD] = $this->hashPassword($values[PROP::PASSWORD]);
        return $this->repo->create($values);
    }

    public function retrieve($id){
        return $this->repo->retrieve(PROP::USER_ID,'id',$id);
    }

    public function update($id,$values){
        if(isset($values[PROP::PASSWORD])){
            $values[PROP::PASSWORD] = $this->hashPassword($values[PROP::PASSWORD]);
        }
        return $this->repo->update($id,$values);
    }

    public function delete($id){
        return $this->repo->delete(PROP::USER_ID,$id);
    }
    public function hashPassword($plainText){
        return hash(PROP::HASH_ALG, $plainText);
    }

}