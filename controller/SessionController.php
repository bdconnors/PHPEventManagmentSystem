<?php


class SessionController {
    static public function index(IRequest $request,IResponse $response){
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
    static public function createForm(IRequest $request,IResponse $response){
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
    static public function create(IRequest $request,IResponse $response){
        $_SERVER['SESSION_SERVICE']->create($request,$response);
    }
}