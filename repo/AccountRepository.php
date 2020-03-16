<?php
require_once('./abstraction/Repository.php');
require_once('./config/prop.php');
require_once('./config/sql.php');
require_once('./model/Account.php');


class AccountRepository extends Repository
{
    protected RoleRepository $roles;
    protected EventRepository $events;
    protected array $accounts;
    public function __construct(Database $db,RoleRepository $roles,EventRepository $events){
        parent::__construct($db);
        $this->roles = $roles;
        $this->events = $events;
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
        $values['events'] = [];
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
            }else {
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
    public function delete($prop, $val){
        for($i = 0; $i < count($this->accounts); $i++){
            $acc = (array) $this->accounts[$i];
            if($acc[$prop] == $val){
                unset($this->accounts[$i]);
            }
        }
        $query = SQL::delete_user . "{$prop} = :{$prop};";
        return $this->db->delete($query,array($prop=>$val));
    }
    public function load(){
        $rows = $this->db->retrieve(SQL::retrieve_all_users,[]);
        foreach ($rows as $row){
            $role = $this->roles->retrieve('id',$row['role']);
            $events = $this->getEvents($row['idattendee']);
            $id = $row['idattendee'];
            unset($row['role']);
            unset($row['idattendee']);
            $row['events'] = $events;
            $row['role'] = $role;
            $row['id'] = $id;
            $account = $this->build($row);
            array_push($this->accounts,$account);
        }
    }
    protected function getEvents($accId){
        $events = [];
        $allEvents = $this->events->retrieveAll();
        foreach($allEvents as $event){
            $registrations = $event->registrations;
            foreach($registrations as $registration){
                $attendeeId = $registration->attendee;
                if($accId == $attendeeId){
                    array_push($events,$event);
                }
            }
        }
        return $events;
    }
    public function build($values){
        return new Account($values['id'],$values['name'],$values['password'],$values['role'],$values['events']);
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