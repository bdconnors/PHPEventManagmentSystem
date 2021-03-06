<?php


class SessionController {
    static public function index( $request, $response){
        $user = $request->getUser();
        $hasSessionId = $request->hasParam('id');
        $hasEventId = $request->hasParam('event');
        if($hasSessionId) {
            $id = $request->query('id');
            $valid = $_SERVER['VALIDATION']->validatePosInteger($id);
            if($valid) {
                $session = $_SERVER['SESSION_REPO']->retrieve('id', $id)[0];
                $registrations = $_SERVER['REGISTRATION_REPO']->retrieve('session', $id);
                $item = array('session' => $session, 'registrations' => $registrations);
                $view = $_SERVER['TEMPLATE_SERVICE']->getProfile('SESSION', $user, $item);
                $response->render($view);
            }else{
                $view = $_SERVER['TEMPLATE_SERVICE']->getError('Page Not Found');
                $response->render($view);
            }
        }else if($hasEventId){
            $eventId = $request->query('event');
            $valid = $_SERVER['VALIDATION']->validatePosInteger($eventId);
            if($valid) {
                $event = $_SERVER['EVENT_REPO']->retrieve('id', $eventId)[0];
                $view = $_SERVER['TEMPLATE_SERVICE']->getList('SESSION', $user, $event);
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
    static public function createForm( $request, $response){
        $user = $request->getUser();
        $hasEventId = $request->hasParam('event');
        if($hasEventId) {
            $eventId = $request->query('event');
            $valid = $_SERVER['VALIDATION']->validatePosInteger($eventId);
            if($valid) {
                $event = $_SERVER['EVENT_REPO']->retrieve('id', $eventId)[0];
                $view = $_SERVER['TEMPLATE_SERVICE']->getCreateSession($user, $event);
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
    static public function updateForm( $request, $response){
        $user = $request->getUser();
        $hasId = $request->hasParam('id');
        if($hasId) {
            $id = $request->query('id');
            $valid = $_SERVER['VALIDATION']->validatePosInteger($id);
            if($valid) {
                $session = $_SERVER['SESSION_REPO']->retrieve('id', $id)[0];
                $view = $_SERVER['TEMPLATE_SERVICE']->getEditSession($user, $session);
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
    static public function create( $request, $response){
        $_SERVER['SESSION_SERVICE']->create($request,$response);
    }
    static public function delete( $request, $response){
        $_SERVER['SESSION_SERVICE']->delete($request,$response);
    }
    static public function update( $request, $response){
        $_SERVER['SESSION_SERVICE']->update($request,$response);
    }

}