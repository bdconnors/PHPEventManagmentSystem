<?php


class EventController {

    static public function index(IRequest $request,IResponse $response){
        $user = $request->getUser();
        if($request->hasParam('id')) {
            $id = $request->query('id');
            $valid = $_SERVER['VALIDATION']->validatePosInteger($id);
            if($valid){
                $event = $_SERVER['EVENT_REPO']->retrieve('id',$id)[0];
                $view = $_SERVER['TEMPLATE_SERVICE']->getProfile('EVENT',$user,$event);
                $response->render($view);
            }else{
                $view = $_SERVER['TEMPLATE_SERVICE']->getError('Page Not Found');
                $response->render($view);
            }
        }else{
            $events = $_SERVER['EVENT_REPO']->retrieveAll();
            $view = $_SERVER['TEMPLATE_SERVICE']->getList('EVENT',$user,$events);
            $response->render($view);
        }
    }
    static public function createForm(IRequest $request,IResponse $response){
        $venues = $_SERVER['VENUE_REPO']->retrieveAll();
        $managers = $_SERVER['ACCOUNT_REPO']->retrieve('role',3);
        $view = $_SERVER['TEMPLATE_SERVICE']->getCreateEvent($request->getUser(),$venues,$managers);
        $response->render($view);
    }
    static public function create(IRequest $request,IResponse $response){
        $_SERVER['ADMIN_SERVICE']->createEvent($request,$response);
    }
    static public function delete(IRequest $request,IResponse $response){
        $service = $_SERVER['ADMIN_SERVICE'];
        $service->deleteEvent($request,$response);
    }

}