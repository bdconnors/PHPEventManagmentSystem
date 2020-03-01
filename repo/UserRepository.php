<?php
require_once('./abstraction/Repository.php');
require_once('./constants/PROP.php');
require_once('./constants/SQL.php');
require_once('./model/User.php');
require_once('./model/Role.php');


class UserRepository extends Repository
{
    public function __construct(EventDatabase $db){
        parent::__construct($db);
    }

    public function retrieveAll(){
        $results = [];
        $rows = $this->db->retrieve(SQL::retrieve_all_users,[]);
        foreach ($rows as $row){
            $user = $this->build($row);
            array_push($results,$user);
        }
        return $results;
    }
    public function create($values){
        return $this->db->create(SQL::create_user,$values);
    }
    public function retrieve($prop,$val){
        $user = false;
        $query = SQL::retrieve_user . "{$prop} = :{$prop};";
        $result = $this->db->retrieve($query,array($prop=>$val))[0];
        if(!empty($result)){
            $user = $this->build($result);
        }
        return $user;
    }

    public function update($values){

    }

    public function delete($prop, $val){
        $query = SQL::delete_user . "{$prop} = :{$prop};";
        return $this->db->delete($query,array($prop=>$val));
    }

    public function build($data){
        $role = new Role($data[PROP::ROLE_ID],$data[PROP::ROLE]);
        return new User($data[PROP::USER_ID],$data[PROP::USER],$data[PROP::PASSWORD],$role);
    }

}