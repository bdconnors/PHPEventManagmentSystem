<?php
require_once('./abstraction/Repository.php');
require_once('./model/Venue.php');
class VenueRepository extends Repository {

    protected array $venues;
    public function __construct(Database $db){
        parent::__construct($db);
        $this->venues = array();
        $this->load();
    }

    public function load(){
        $rows = $this->db->retrieve(SQL::retrieve_all_venues,[]);
        foreach ($rows as $row){
            $id = $row['idvenue'];
            unset($row['idvenue']);
            $row['id'] = $id;
            $venue = $this->build($row);
            array_push($this->venues,$venue);
        }
    }
    public function retrieveAll(){
        return $this->venues;
    }

    public function retrieve($prop, $value){
        $results = [];
        foreach($this->venues as $v){
            $venue = (array) $v;
            if($venue[$prop] == $value){
                array_push($results,$v);
            }
        }
        return $results;
    }

    public function create($values){
        // TODO: Implement create() method.
    }

    public function update($id,$values){
        // TODO: Implement update() method.
    }

    public function delete($prop, $value){
        // TODO: Implement delete() method.
    }

    public function build($values){
        return new Venue($values['id'],$values['name'],$values['capacity']);
    }

}