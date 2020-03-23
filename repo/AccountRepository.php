<?php
require_once('./abstraction/Repository.php');
require_once('./config/prop.php');
require_once('./config/sql.php');
require_once('./model/Account.php');


class AccountRepository extends Repository
{
    protected RoleRepository $roles;
    protected RegistrationRepository $registrations;
    protected array $accounts;
    public function __construct(Database $db,RoleRepository $roles,RegistrationRepository $reg){
        parent::__construct($db);
        $this->roles = $roles;
        $this->registrations = $reg;
        $this->accounts = array();
        $this->load();
    }
    public function retrieveAll(){
        return $this->accounts;
    }
    public function create($values){
        $accountId = $this->db->create(SQL::create_user, $values);
        $role = $this->roles->retrieve('id', $values['role']);
        unset($values['role']);
        $values['id'] = $accountId;
        $values['role'] = $role;
        $values['registrations'] = $this->registrations->retrieve('attendee',$accountId);
        $account = $this->build($values);
        array_push($this->accounts, $account);
        return $account;

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
    public function update($id,$values){
        $account = $this->retrieve('id',$id);
        foreach($values as $key => $value){
            $account[$key] = $value;
        }
        $query = $this->buildUpdateQuery($id,$values);
        return $this->db->update($query,$values);
    }
    public function delete($id){
        for($i = 0; $i < count($this->accounts); $i++){
            $acc = (array) $this->accounts[$i];
            if($acc['id'] == $id){
                unset($this->accounts[$i]);
            }
        }
        $query = SQL::delete_user . "idattendee = :id;";
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
            $registrations = $this->registrations->retrieve('attendee',$row['idattendee']);
            $id = $row['idattendee'];
            unset($row['role']);
            unset($row['idattendee']);
            $row['registrations'] = $registrations;
            $row['role'] = $role;
            $row['id'] = $id;
            $account = $this->build($row);
            array_push($this->accounts,$account);
        }
    }
    public function getDefault(){
        $role = $this->roles->getDefault();
        return new Account(-1,'To Be Determined','none',$role,[]);
    }
    public function build($values){
        return new Account($values['id'],$values['name'],$values['password'],$values['role'],$values['registrations']);
    }
    public function buildUpdateQuery($id,$values){
        $query = SQL::UPDATE.PROP::USER.SQL::SET;
        $keys = array_keys($values);
        $keyCount = count($keys);
        for($i = 0; $i < $keyCount; $i++){
            $key = $keys[$i];
            $query.=$key.' = :'.$key;
            if($i != $keyCount-1){
                $query.=",";
            }
        }
        $query.= SQL::WHERE.PROP::USER_ID.' = '.$id;
        return $query;
    }

}