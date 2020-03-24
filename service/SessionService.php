<?php


class SessionService {
    public function __construct(){}

    public function create(IRequest $request,IResponse $response){
        $body = $request->getBody();
        var_dump($body);
        $validEventId = $_SERVER['VALIDATION']->validatePosInteger($body['event']);
        $validName = $_SERVER['VALIDATION']->validateAlphaNumericSpaces($body['name']);
        $validNumberAllowed = $_SERVER['VALIDATION']->validatePosInteger($body['numberallowed']);
        $validDateStart = $_SERVER['VALIDATION']->validateDate($body['startdate']);
        $validDateEnd = $_SERVER['VALIDATION']->validateDate($body['enddate']);
        $valid = $validEventId && $validName && $validNumberAllowed && $validDateStart && $validDateEnd;
        if($valid){
            $_SERVER['SESSION_REPO']->create($body);
            $response->redirect("/sessions?event={$body['event']}");
        }else{
            $response->send('invalid input');
        }
    }
}