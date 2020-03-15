<?php
require_once('./abstraction/Repository.php');
require_once('./model/Event.php');
class EventRepository extends Repository {
    protected array $events;
    public function __construct(Database $db){
        parent::__construct($db);
        $this->events = array();
        $this->load();
    }
    public function load(){
        $rows = $this->db->retrieve(SQL::retrieve_all_events,[]);
        foreach ($rows as $row){
            $id = $row['idevent'];
            unset($row['idevent']);
            $row['id'] = $id;
            $event = $this->build($row);
            array_push($this->events,$event);
        }
    }
    public function retrieveAll(){
        return $this->events;
    }

    public function retrieve($prop, $value){
        $results = [];
        foreach($this->events as $e){
            $event = (array) $e;
            if($event[$prop] == $value){
                array_push($results,$e);
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
        return new Event($values['id'],$values['name'],$values['datestart'],$values['dateend'],$values['numberallowed'],$values['venue']);
    }

}