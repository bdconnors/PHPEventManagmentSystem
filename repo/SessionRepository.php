<?php

require_once('./abstraction/Repository.php');
class SessionRepository extends Repository {

    protected $sessions;
    public function __construct($db){
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
    public function registerAttendee($accId,$sessionId){
        $values = array('attendee'=>$accId,'session'=>$sessionId);
        return $this->db->create(SQL::create_attendee_session,$values);
    }
    public function unregisterAttendee($accId,$sessionId){
        $values = array('attendee'=>$accId,'session'=>$sessionId);
        return $this->db->delete(SQL::delete_attendee_session,$values);
    }
    public function create($values){
        unset($values['nameConfirm']);
        var_dump($values);
        return $this->db->create(SQL::create_session,$values);
    }
    public function update($values){
        return $this->db->update(SQL::update_session,$values);
    }
    public function delete($id){
        $values = array('id'=>$id);
        return $this->db->delete(SQL::delete_session,$values);
    }
    public function deleteEventSessions($eventId){
        $sessions = $this->retrieve('event',$eventId);
        if(count($sessions) > 0) {
            $ids = $this->extractIds($sessions);
            $params = $this->buildParamArray($ids);
            $query = $this->buildDeleteAttendeeSessionsQuery(count($ids));
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
        $query = SQL::delete_attendee_session_begin;
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