<?php


class RegistrationService {
    public function __construct(){}
    public function create(IRequest $request,IResponse $response){
        $validation = $_SERVER['VALIDATION'];
        $body = $request->getBody();
        $validSession = $validation->validatePosInteger($body['session']);
        $validAttendee = $validation->validatePosInteger($body['attendee']);
        $validEvent = $validation->validatePosInteger($body['event']);
        $valid = $validSession && $validAttendee && $validEvent;
        if($valid){
            $hasPaid = !empty($body['paid']);
            if($hasPaid){
                $body['paid'] = 0;
            }else{
                $body['paid'] = 1;
            }
            $_SERVER['REGISTRATION_REPO']->create($body);
            $response->redirect("/registrations?event={$body['event']}");
        }else{
            $response->send('invalid input');
        }
    }

}