<?php

require_once './model/Registration.php';
class RegistrationRepository extends Repository
{
    protected $registrations;
    protected $sessions;
    protected $accounts;
    public function __construct($db,$sessions, $accounts){
        parent::__construct($db);
        $this->sessions = $sessions;
        $this->accounts = $accounts;
        $this->registrations = array();
        $this->load();
    }

    public function load(){
        $rows = $this->db->retrieve(SQL::retrieve_all_registrations,[]);
        $count = count($this->registrations);
        foreach($rows as $row){;
            $row['id'] = $count;
            $row['session'] = $this->sessions->retrieve('id',$row['session'])[0];
            $row['attendee'] = $this->accounts->retrieve('id',$row['attendee'])[0];
            $registration =  $this->build($row);
            array_push(    $this->registrations,$registration);
            $count++;
        }
    }
    public function retrieveAll() {
        return $this->registrations;
    }
    public function retrieve($prop, $value){
        $results = [];
        foreach($this->registrations as $r){
            $reg = (array) $r;
            if($prop == 'session'){
                if($r->session->id == $value){
                    array_push($results, $r);
                }
            }else if($prop == 'attendee'){
                if($r->attendee->id == $value){
                    array_push($results, $r);
                }
            }else {
                if ($reg[$prop] == $value) {
                    array_push($results, $r);
                }
            }

        }
        return $results;
    }

    public function create($values){
        $this->accounts->registerEvent($values['attendee'],$values['event'],$values['paid']);
        return $this->sessions->registerAttendee($values['attendee'],$values['session']);
    }

    public function update($values){
        $id = $values['id'];
        $registration = $this->retrieve('id',$id)[0];
        $attendeeId = $registration->attendee->id;
        $sessionId = $registration->session->id;
        $eventId = $registration->event;
        $paid = $registration->paid;
        if(!empty($values['paid'])){
            $paid = 0;
        }else{
            $paid = 1;
        }
        $sessionVals = array('session'=>$values['session'],'attendee'=>$attendeeId,'id'=>$sessionId);
        $eventVals = array('paid'=>$paid,'attendee'=>$attendeeId,'id'=>$eventId);
        $this->db->update(SQL::update_attendee_session,$sessionVals);
        return $this->db->update(SQL::update_attendee_event,$eventVals);
    }

    public function delete($id) {
        $registration = $this->retrieve('id',$id)[0];
        $accId = $registration->attendee->id;
        $eventId = $registration->event;
        $sessionId = $registration->session->id;
        $this->accounts->unregisterEvent($accId,$eventId);
        return $this->sessions->unregisterAttendee($accId,$sessionId);
    }
    public function deleteEventSession($sessionId){
        $registrations = $this->retrieve('session',$sessionId);
        foreach($registrations as $registration){
            $this->delete($registration->id);
        }
        return $this->sessions->delete($sessionId);
    }
    public function deleteEventRegistrations($eventId){
        $result = $this->db->delete(SQL::delete_event_attendees,array('id'=>$eventId));
        $registrations = $this->retrieve('event',$eventId);
        $regIds = $this->extractIds($registrations);
        for($i = 0; $i < count($this->registrations); $i++){
            if(in_array($this->registrations[$i]->id,$regIds)){
                unset($this->registrations[$i]);
            }
        }
        return $result;
    }
    public function extractIds($entities){
        $ids = array();
        foreach($entities as $entity){
            array_push($ids,$entity->id);
        }
        return $ids;
    }
    public function build($values){
        return new Registration(
            $values['id'],
            $values['name'],
            $values['event'],
            $values['attendee'],
            $values['session'],
            $values['paid']
        );
    }
}