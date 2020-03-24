<?php
require_once('./abstraction/Repository.php');
require_once('./config/prop.php');
require_once('./config/sql.php');
require_once('./model/Account.php');


class AccountRepository extends Repository
{
    protected RoleRepository $roles;
    protected array $accounts;
    public function __construct(Database $db,RoleRepository $roles){
        parent::__construct($db);
        $this->roles = $roles;
        $this->accounts = array();
        $this->load();
    }
    public function retrieveAll(){
        return $this->accounts;
    }
    public function create($values){
        $values['password'] = $this->hashPassword($values['password']);
        unset($values['passwordConfirm']);
        unset($values['nameConfirm']);
        return $this->db->create(SQL::create_user, $values);
    }
    public function retrieve($prop,$val){
        $results = [];
        foreach($this->accounts as $a){
            $acc = (array) $a;
            if($prop == 'role'){
                $role = (array)$acc[$prop];
                if ($role['id'] == $val) {
                    array_push($results,$a);
                }
            }else if($prop == 'name'){
                $val = strtoupper($val);
                if(strtoupper($a->name) == $val){
                    array_push($results,$a);
                }
            }else{
                if ($acc[$prop] == $val) {
                    array_push($results,$a);
                }
            }
        }
        return $results;
    }
    public function update($values){
        if(array_key_exists('password',$values)){
            $values['password'] = $this->hashPassword($values['password']);
            unset($values['passwordConfirm']);
        }
        $query = $this->buildUpdateQuery($values);
        return $this->db->update($query,$values);
    }
    public function delete($id){
        $query = SQL::delete_user;
        return $this->db->delete($query,array('id'=>$id));
    }
    public function exists($name){
        $exists = false;
        $name = strtoupper($name);
        foreach($this->accounts as $account){
            if (strtoupper($account->name) == $name) {
                $exists = true;
            }
        }
        return $exists;
    }
    public function load(){
        $rows = $this->db->retrieve(SQL::retrieve_all_users,[]);
        foreach ($rows as $row){
            $role = $this->roles->retrieve('id',$row['role']);
            $id = $row['idattendee'];
            unset($row['role']);
            unset($row['idattendee']);
            $row['role'] = $role;
            $row['id'] = $id;
            $account = $this->build($row);
            array_push($this->accounts,$account);
        }
    }
    public function getDefault(){
        $role = $this->roles->getDefault();
        return new Account(-1,'To Be Determined','none',$role);
    }
    public function build($values){
        return new Account($values['id'],$values['name'],$values['password'],$values['role']);
    }
    public function registerEvent($accId,$eventId,$paid){
        $values = array('attendee'=>$accId,'event'=>$eventId,'paid'=>$paid);
        return $this->db->create(SQL::create_attendee_event,$values);
    }
    public function unregisterEvent($accId,$eventId){
        $values = array('attendee'=>$accId,'event'=>$eventId);
        return $this->db->delete(SQL::delete_attendee_event,$values);
    }
    public function buildUpdateQuery($values){
        $id = $values['id'];
        unset($values['id']);
        if(array_key_exists('password',$values)){unset($values['passwordConfirm']);}
        $query = SQL::update_user;
        $keys = array_keys($values);
        $keyCount = count($keys);
        for($i = 0; $i < $keyCount; $i++){
            $key = $keys[$i];
            $query.=$key.' = :'.$key;
            if($i != $keyCount-1){$query.=",";}
        }
        $values['id'] = $id;
        $query.= ' WHERE idattendee = :id';
        return $query;
    }
    public function hashPassword($plainText){
        return hash(PROP::HASH_ALG, $plainText);
    }

}