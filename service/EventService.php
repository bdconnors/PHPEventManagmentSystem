<?php


class EventService {
    public function __construct(){}

    public function create( $request,  $response){
        $body = $request->getBody();
        $validation = $_SERVER['VALIDATION'];
        $name = $body['name'];
        $validName = $validation->validateAlphaNumericSpaces($name);
        $dateStart = $body['datestart'];
        $validDateStart = $validation->validateDate($dateStart);
        $dateEnd = $body['dateend'];
        $validDateEnd = $validation->validateDate($dateEnd);
        $manager = $body['manager'];
        $validManager = $validation->validateAnyInteger($manager);
        $venue = $body['venue'];
        $validVenue = $validation->validateAnyInteger($venue);
        $numberAllowed = $body['numberallowed'];
        $validNumberAllowed = $validation->validatePosInteger($numberAllowed);
        $valid = $validName && $validDateStart && $validDateEnd && $validManager && $validVenue && $validNumberAllowed;
        if($valid){
            $result = $_SERVER['EVENT_REPO']->create($body);
            $response->redirect('/events');
        }else{
            $response->sendJSON('Invalid Input');
        }
    }
    public function delete( $request, $response){
        $id = $request->getBody()['id'];
        $validation = $_SERVER['VALIDATION'];
        if($validation->validatePosInteger($id)) {
            $response->sendJSON($_SERVER['EVENT_REPO']->delete($id));
            $response->redirect('/events');
        }else{
            $response->sendJSON('Invalid Event ID');
        }

    }

}