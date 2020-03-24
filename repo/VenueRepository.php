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
        unset($values['nameConfirm']);
        $venueId = $this->db->create(SQL::create_venue,$values);
        $values['id'] = $venueId;
        $venue = $this->build($values);
        array_push($this->venues,$venue);
        return $venue;
    }

    public function update($values){
        $this->db->update(SQL::update_venue,$values);
        $venue = $this->retrieve('id',$values['id']);
        $venue->name = $values['name'];
        $venue->capacity = $values['capacity'];
        return $venue;
    }

    public function delete($id){
        $results = $this->db->delete(SQL::delete_venue,array('id'=>$id));
        $this->db->update(SQL::update_event_venue,array('venue'=>-1,'id'=>$id));
        for($i = 0; $i < count($this->venues); $i++){
            if($this->venues[$i]->id == $id){
                unset($this->venues[$i]);
            }
        }
        return $results;
    }
    public function getDefault(){
        return new Venue(-1,'To Be Determined',-1);
    }
    public function build($values){
        return new Venue($values['id'],$values['name'],$values['capacity']);
    }

}