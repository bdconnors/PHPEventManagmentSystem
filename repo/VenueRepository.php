<?php
require_once('./abstraction/Repository.php');
require_once('./model/Venue.php');
class VenueRepository extends Repository {

    protected array $venues;
    protected EventRepository $events;
    public function __construct(Database $db,EventRepository $events){
        parent::__construct($db);
        $this->venues = array();
        $this->events = $events;
        $this->load();
    }

    public function load(){
        $rows = $this->db->retrieve(SQL::retrieve_all_venues,[]);
        foreach ($rows as $row){
            $id = $row['idvenue'];
            $row['events'] = $this->events->retrieve('venue',$id);
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
        $selectedVenue = false;
        foreach($this->venues as $v){
            $role = (array) $v;
            if($role[$prop] == $value){
                $selectedVenue= $v;
            }
        }
        return $selectedVenue;
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
        return new Venue($values['id'],$values['name'],$values['capacity'],$values['events']);
    }

}