<?php

require_once'./model/Role.php';
require_once'./abstraction/Repository.php';
require_once'./config/sql.php';
class RoleRepository extends Repository {
    protected array $roles;
    public function __construct(Database $db){
        parent::__construct($db);
        $this->roles = array();
        $this->load();
    }
    public function load() {
        $rows = $this->db->retrieve(SQL::retrieve_all_roles,[]);
        foreach ($rows as $row){
            $role = $this->build($row);
            array_push($this->roles,$role);
        }
    }
    public function retrieveAll() {
        return $this->roles;
    }
    public function retrieve($prop, $value) {
        $selectedRole = false;
        foreach($this->roles as $r){
            $role = (array) $r;
            if($role[$prop] == $value){
                $selectedRole= $r;
            }
        }
        return $selectedRole;
    }
    public function create($values)
    {
        // TODO: Implement create() method.
    }

    public function update($id, $values)
    {
        // TODO: Implement update() method.
    }

    public function delete($prop, $value)
    {
        // TODO: Implement delete() method.
    }

    public function build($values){
        return new Role($values['idrole'],$values['name']);
    }
}