<?php

require_once './model/Registration.php';
class RegistrationRepository extends Repository
{
    protected array $registrations;
    protected SessionRepository $sessions;
    protected AccountRepository $accounts;
    public function __construct(Database $db,SessionRepository $sessions,AccountRepository $accounts){
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
        $this->accounts->registerEventAttendee($values['attendee'],$values['event'],$values['paid']);
        return $this->sessions->registerSessionAttendee($values['attendee'],$values['session']);
    }

    public function update($values)
    {
        // TODO: Implement update() method.
    }

    public function delete($id) {

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