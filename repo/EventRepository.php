<?php
require_once('./abstraction/Repository.php');
require_once('./model/Event.php');
require_once('./model/Registration.php');
require_once('./model/Session.php');
class EventRepository extends Repository {
    protected VenueRepository $venues;
    protected SessionRepository $sessions;
    protected RegistrationRepository $registrations;
    protected AccountRepository $accounts;
    protected array $events;
    public function __construct(Database $db,$venues,$sessions,$registrations,$accounts){
        parent::__construct($db);
        $this->venues = $venues;
        $this->sessions = $sessions;
        $this->registrations = $registrations;
        $this->accounts = $accounts;
        $this->events = array();
        $this->load();
    }
    public function load(){
        $eventRows = $this->db->retrieve(SQL::retrieve_all_events,[]);
        foreach ($eventRows as $row){
            $id = $row['idevent'];
            $venueId = $row['venue'];
            unset($row['idevent']);
            unset($row['venue']);
            $row['id'] = $id;
            $row['venue'] = $this->getEventVenue($venueId);
            $row['manager'] = $this->getEventManager($id);
            $row['registrations'] = $this->registrations->retrieve('event',$row['id']);
            $row['sessions'] = $this->sessions->retrieve('event',$id);
            $event = $this->build($row);
            array_push($this->events,$event);
        }

    }
    public function getEventVenue($venueId){
        if($venueId!= -1) {
            return $this->venues->retrieve('id', $venueId)[0];
        }else{
            return $this->venues->getDefault();
        }
    }
    public function getEventManager($eventId){
        $result = $this->db->retrieve(SQL::retrieve_event_manager,['id'=>$eventId]);
        if(!empty($result[0])) {
            $managerId = $result[0]['manager'];
            if ($managerId != -1) {
                return $this->accounts->retrieve('id', $managerId)[0];
            } else {
                return $this->accounts->getDefault();
            }
        }else{
            return $this->accounts->getDefault();
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
        $managerValues = array('manager'=>$values['manager']);
        unset($values['nameConfirm']);
        unset($values['manager']);
        $eventId = $this->db->create(SQL::create_event,$values);
        $managerValues['event'] = $eventId;
        $this->db->create(SQL::create_event_manager, $managerValues);
        $values['manager'] = $this->getEventManager($eventId);
        $values['registrations'] = [];
        $values['sessions'] = [];
        $values['id'] = $eventId;
        $event = $this->build($values);
        array_push($this->events,$event);
        return $event;
    }
    public function update($values){
        // TODO: Implement update() method.
    }
    public function delete($id){
        $this->sessions->deleteEventSessions($id);
        $this->registrations->deleteEventRegistrations($id);
        $this->db->delete(SQL::delete_event_management,array('id'=>$id));
        $results = $this->db->delete(SQL::delete_event,array('id'=>$id));
        for($i = 0; $i < count($this->events); $i++){
            if($this->events[$i]->id == $id){
                unset($this->events[$i]);
            }
        }
        return $results;
    }
    public function build($values){

        return new Event($values['id'],
            $values['name'],
            $values['datestart'],
            $values['dateend'],
            $values['numberallowed'],
            $values['venue'],
            $values['manager'],
            $values['registrations'],
            $values['sessions']);
    }

}