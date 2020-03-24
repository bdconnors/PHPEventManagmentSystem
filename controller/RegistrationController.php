<?php


class RegistrationController
{
    static public function index(IRequest $request,IResponse $response){
        $user = $request->getUser();
        $hasId =  $hasEventId = $request->hasParam('id');
        $hasEvent = $request->hasParam('event');
       if($hasId) {
           $id = $request->query('id');
           $valid = $_SERVER['VALIDATION']->validatePosInteger($id);
           if ($valid) {
               $registration = $_SERVER['REGISTRATION_REPO']->retrieve('id', $id)[0];
               $view = $_SERVER['TEMPLATE_SERVICE']->getProfile('REGISTRATION', $user, $registration);
               $response->render($view);
           } else {
               $view = $_SERVER['TEMPLATE_SERVICE']->getError('Page Not Found');
               $response->render($view);
           }
       }else if($hasEvent) {
           $eventId = $request->query('event');
           $valid = $_SERVER['VALIDATION']->validatePosInteger($eventId);
           if ($valid) {
               $event = $_SERVER['EVENT_REPO']->retrieve('id',$eventId)[0];
               $registrations = $event->registrations;
               $items = array('registrations'=>$registrations,'event'=>$event);
               $view = $_SERVER['TEMPLATE_SERVICE']->getList('REGISTRATION', $user,$items);
               $response->render($view);
           } else {
               $view = $_SERVER['TEMPLATE_SERVICE']->getError('Page Not Found');
               $response->render($view);
           }
       }else{
            $registrations = $_SERVER['REGISTRATION_REPO']->retrieve('attendee',$user->id);
            $view = $_SERVER['TEMPLATE_SERVICE']->getList('REGISTRATION',$user,$registrations);
            $response->render($view);
        }
    }
    static public function createForm(IRequest $request,IResponse $response){
        $user = $request->getUser();
        $hasEvent = $request->hasParam('event');
        $hasAttendee = $request->hasParam('attendee');
        if($hasEvent && $hasAttendee) {
            $eventId = $request->query('event');
            $attendeeId = $request->query('attendee');
            $validEvent = $_SERVER['VALIDATION']->validatePosInteger($eventId);
            $validAttendee = $_SERVER['VALIDATION']->validatePosInteger($attendeeId);
            $valid = $validEvent && $validAttendee;
            if($valid){
                $event = $_SERVER['EVENT_REPO']->retrieve('id',$eventId)[0];
                $attendee = $_SERVER['ACCOUNT_REPO']->retrieve('id',$attendeeId)[0];
                $view = $_SERVER['TEMPLATE_SERVICE']->getCreateRegistration($user,$event,$attendee);
                $response->render($view);
            }else{
                $view = $_SERVER['TEMPLATE_SERVICE']->getError('Page Not Found');
                $response->render($view);
            }
        }else{
            $view = $_SERVER['TEMPLATE_SERVICE']->getError('Page Not Found');
            $response->render($view);
        }
    }
    static public function updateForm(IRequest $request,IResponse $response){
        $user = $request->getUser();
        $hasId= $request->hasParam('id');
        if($hasId) {
            $id = $request->query('id');
            $valid = $_SERVER['VALIDATION']->validatePosInteger($id);
            if($valid){
                $registration = $_SERVER['REGISTRATION_REPO']->retrieve('id',$id)[0];
                $eventId = $registration->event;
                $event = $_SERVER['EVENT_REPO']->retrieve('id',$eventId)[0];
                $view = $_SERVER['TEMPLATE_SERVICE']->getEditRegistration($user,$registration,$event);
                $response->render($view);
            }else{
                $view = $_SERVER['TEMPLATE_SERVICE']->getError('Page Not Found');
                $response->render($view);
            }
        }else{
            $view = $_SERVER['TEMPLATE_SERVICE']->getError('Page Not Found');
            $response->render($view);
        }
    }
    static public function create(IRequest $request,IResponse $response){
        $_SERVER['REGISTRATION_SERVICE']->create($request,$response);
    }
    static public function delete(IRequest $request,IResponse $response){
        $_SERVER['REGISTRATION_SERVICE']->delete($request,$response);
    }
    static public function update(IRequest $request,IResponse $response){
        $_SERVER['REGISTRATION_SERVICE']->update($request,$response);
    }
}