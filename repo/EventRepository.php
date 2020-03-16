<?php
require_once('./abstraction/Repository.php');
require_once('./model/Event.php');
require_once('./model/Registration.php');
require_once('./model/Session.php');
class EventRepository extends Repository {
    protected array $events;
    protected VenueRepository $venues;
    public function __construct(Database $db,$venues){
        parent::__construct($db);
        $this->venues = $venues;
        $this->events = array();
        $this->load();
    }
    public function load(){
        $eventRows = $this->db->retrieve(SQL::retrieve_all_events,[]);
        $managedEventRows = $this->db->retrieve(SQL::retrieve_all_managed_events,[]);
        $registrationRows = $this->db->retrieve(SQL::retrieve_all_registrations,[]);
        $sessionRows = $this->db->retrieve(SQL::retrieve_all_sessions,[]);
        foreach ($eventRows as $row){
            $id = $row['idevent'];
            $venueId = $row['venue'];
            unset($row['idevent']);
            unset($row['venue']);
            $row['id'] = $id;
            $row['venue'] = $this->venues->retrieve('id',$venueId)[0];
            $row['manager'] = $this->getManager($row,$managedEventRows);
            $row['registrations'] = $this->getRegistrations($row,$registrationRows);
            $row['sessions'] = $this->getSessions($row,$sessionRows);
            $event = $this->build($row);
            array_push($this->events,$event);
        }
    }
    public function getSessions($eventRow,$sessRows){
        $sessions = [];
        foreach($sessRows as $row){
            $id = $eventRow['id'];
            if($row['event'] == $id){
                $id = $row['idsession'];
                $name = $row['name'];
                $datestart = $row['startdate'];
                $dateend = $row['enddate'];
                $allowed = $row['numberallowed'];
                $event = $row['event'];
                $session =  new Session($id,$name,$datestart,$dateend,$allowed,$event);
                array_push($sessions,$session);
            }
        }
        return $sessions;
    }
    public function getRegistrations($eventRow,$regRows){
        $registrations = [];
        foreach($regRows as $row){
            $id = $eventRow['id'];
            if($row['event'] == $id){
                $name = $eventRow['name'];
                $attendee = $row['attendee'];
                $paid = $row['paid'];
                $registration =  new Registration($id,$name,$attendee,$paid);
                array_push($registrations,$registration);
            }
        }
        return $registrations;
    }
    public function getManager($eventRow,$managedRows){
        $manager = -1;
        foreach($managedRows as $row){
            $id = $eventRow['id'];
            if($row['event'] == $id){
                $manager = $row['manager'];
            }
        }
        return $manager;
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