<?php

require_once('./abstraction/Repository.php');
class SessionRepository extends Repository {

    protected array $sessions;
    public function __construct(Database $db){
        parent::__construct($db);
        $this->sessions = array();
        $this->load();
    }
    public function load(){
        $rows = $this->db->retrieve(SQL::retrieve_all_sessions,[]);
        foreach($rows as $row){
            $id = $row['idsession'];
            unset($row['idsession']);
            $row['id'] = $id;
            $session = $this->build($row);
            array_push($this->sessions,$session);
        }

    }
    public function retrieveAll(){
        return $this->sessions;
    }

    public function retrieve($prop, $value){
        $results = [];
        foreach($this->sessions as $s){
            $session = (array) $s;
            if($session[$prop] == $value){
                array_push($results,$s);
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

    public function delete($id){
        // TODO: Implement delete() method.
    }
    public function deleteEventSessions($eventId){
        $sessions = $this->retrieve('event',$eventId);
        if(count($sessions) > 0) {
            var_dump($sessions);
            $ids = $this->extractIds($sessions);
            $params = $this->buildParamArray($ids);
            var_dump($params);
            $query = $this->buildDeleteAttendeeSessionsQuery(count($ids));
            var_dump($query);
            $this->db->delete($query, $params);
            for($i = 0; $i < count($this->sessions); $i++){
                if(in_array($this->sessions[$i]->id,$ids)){
                    unset($this->sessions[$i]);
                }
            }
        }
        return $this->db->delete(SQL::delete_event_sessions,array('id'=>$eventId));
    }
    public function extractIds($sessions){
        $ids = array();
        foreach($sessions as $session){
            array_push($ids,$session->id);
        }
        return $ids;
    }
    public function buildParamArray($values){
        $params = array();
        for($i = 0 ; $i < count($values); $i++){
            $params["param{$i}"] = $values[$i];
        }
        return $params;
    }
    public function buildDeleteAttendeeSessionsQuery($count){
        var_dump($count);
        $query ="DELETE FROM ATTENDEE_SESSION WHERE ";
        for($i = 0; $i < $count; $i++){
            $query .= "session = :param{$i}";
            if($i != $count-1) {
                $query.= " OR ";
            }
        }
        return $query;
    }
    public function build($values){
        return new Session($values['id'],
            $values['name'],
            $values['startdate'],
            $values['enddate'],
            $values['numberallowed'],
            $values['event']);
    }

}