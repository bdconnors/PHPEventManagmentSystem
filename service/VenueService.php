<?php


class VenueService {
    public function __construct(){}

    public function create(IRequest $request,IResponse $response){
        $values = $request->getBody();
        $validName = $_SERVER['VALIDATION']->validateAlphaNumericSpaces($values['name']);
        $validCapacity = $_SERVER['VALIDATION']->validatePosInteger($values['capacity']);
        $valid = $validName && $validCapacity;
        if($valid) {
            $_SERVER['VENUE_REPO']->create($values);
            $response->redirect('/venues');
        }else{
            $response->send("Invalid Input");
        }
    }
    public function delete(IRequest $request,IResponse $response){
        $id = $request->getBody()['id'];
        $validation = $_SERVER['VALIDATION'];
        if($validation->validatePosInteger($id)) {
            $_SERVER['VENUE_REPO']->delete($id);
            $response->redirect('/venues');
        }else{
            $response->sendJSON('Invalid Event ID');
        }

    }
    public function update(IRequest $request,IResponse $response){
        $body = $request->getBody();
        $validation = $_SERVER['VALIDATION'];
        $validId = $validation->validatePosInteger($body['id']);
        $validName = $validation->validateAlphaNumericSpaces($body['name']);
        $validCapacity = $validation->validateAlphaNumericSpaces($body['capacity']);
        $valid = $validId && $validName && $validCapacity;
        if($valid) {
            $_SERVER['VENUE_REPO']->update($body);
            $response->redirect("/venues?id={$body['id']}");
        }else{
            $response->sendJSON('Invalid Input');
        }
    }
}